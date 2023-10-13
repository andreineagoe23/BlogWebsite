function loadMorePosts() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var morePosts = xhr.responseText;
        var recentPostsSection = document.querySelector('.recent-posts');
        recentPostsSection.innerHTML += morePosts;
  
        // Remove the "View More" button
        var viewMoreButton = document.getElementById('view-more-btn');
        viewMoreButton.parentNode.removeChild(viewMoreButton);
      }
    };
    xhr.open('GET', 'viewBlog.php?offset=2', true);
    xhr.send();
  }
  