$(document).ready(function () {
    // Setup CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Fetch posts for a specific page or search term
    function fetchPosts(page = 1, searchTerm = '') {
        $.ajax({
            url: `/posts?page=${page}&search=${searchTerm}`,
            type: 'GET',
            success: function (response) {
                if (response.data.length > 0) {
                    renderPosts(response.data);
                    renderPagination(response);
                } else {
                    renderNoDataFound();
                }
            },
            error: function (err) {
                console.error('Error fetching posts:', err);
            }
        });
    }

    // Render posts
    function renderPosts(posts) {
        $('#postList').empty();
        posts.forEach(post => {
            const postHtml = `
                <div class="card mt-3" id="post-${post.id}">
                    <div class="card-body">
                        <h5 class="card-title">${post.title}</h5>
                        <p class="card-text">${post.content}</p>
                        <button class="btn btn-warning edit-btn" data-id="${post.id}">Edit</button>
                        <button class="btn btn-danger delete-btn" data-id="${post.id}">Delete</button>
                    </div>
                </div>
            `;
            $('#postList').append(postHtml);
        });
    }

    // Render pagination links
    function renderPagination(data) {
        const {
            current_page,
            last_page
        } = data;
        const paginationNav = $('#paginationNav');
        paginationNav.empty();

        let paginationHtml = '<ul class="pagination">';

        // Previous button
        if (current_page > 1) {
            paginationHtml +=
                `<li class="page-item"><a class="page-link" href="#" data-page="${current_page - 1}">Previous</a></li>`;
        }

        // Page numbers with ellipses
        const range = 6; // Number of pages per block to show
        const pages = [];

        // Add the first page
        if (current_page > range) {
            pages.push(1);
        }

        // Add pages after the first page
        let currentBlockStart = Math.floor((current_page - 1) / range) * range + 1;
        for (let i = currentBlockStart; i < currentBlockStart + range && i <= last_page; i++) {
            if (!pages.includes(i)) {
                pages.push(i);
            }
        }

        // If there are more pages after the current block, add ellipsis
        if (pages[pages.length - 1] < last_page) {
            pages.push('...');
        }

        // Render page numbers and ellipses
        for (let i = 0; i < pages.length; i++) {
            if (pages[i] === '...') {
                paginationHtml += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
            } else {
                paginationHtml += `
                    <li class="page-item ${pages[i] === current_page ? 'active' : ''}">
                        <a class="page-link" href="#" data-page="${pages[i]}">${pages[i]}</a>
                    </li>`;
            }
        }

        // Next button
        if (current_page < last_page) {
            paginationHtml +=
                `<li class="page-item"><a class="page-link" href="#" data-page="${current_page + 1}">Next</a></li>`;
        }

        paginationHtml += '</ul>';
        paginationNav.html(paginationHtml);
    }

    // Render "No data found" message
    function renderNoDataFound() {
        $('#postList').empty();
        const noDataMessage = `
            <div class="alert alert-info" role="alert">
                No data found matching your search criteria.
            </div>
        `;
        $('#postList').append(noDataMessage);
    }

    // Handle pagination click
    $(document).on('click', '.page-link', function (e) {
        e.preventDefault();
        const page = $(this).data('page');
        const searchTerm = $('#search').val();
        fetchPosts(page, searchTerm);
    });

    // Handle search input
    $('#search').on('keyup', function () {
        const searchTerm = $(this).val();
        fetchPosts(1, searchTerm); // Start from page 1 when searching
    });

    // Submit new post
    $('#postForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/posts',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Post added successfully',
                    showConfirmButton: false,
                    timer: 1500
                });
                fetchPosts(); // Refresh posts
                $('#postForm')[0].reset();
            },
            error: function (err) {
                console.error('Error creating post:', err);
            }
        });
    });

    // Initial fetch of posts
    fetchPosts();

    // Delete a post
    $(document).on('click', '.delete-btn', function () {
        const id = $(this).data('id');
        $.ajax({
            url: `/posts/${id}`,
            type: 'DELETE',
            success: function () {
                $(`#post-${id}`).remove(); // Remove the post from the DOM
                alert('Post deleted successfully!');
                window.location.href = '/login';
            },
            error: function (err) {
                console.error('Error deleting post:', err);
                alert('Failed to delete post.');
            }
        });
    });


});