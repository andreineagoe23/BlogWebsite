document.getElementById("clearBtn").addEventListener("click", function() {
  const confirmClear = confirm("Do you want to clear the form?");
  if (confirmClear) {
      document.getElementById("title").value = "";
      document.getElementById("post").value = "";
  }
});

document.getElementById("addPostForm").addEventListener("submit", function(event) {
  const title = document.getElementById("title").value.trim();
  const post = document.getElementById("post").value.trim();

  if (!title || !post) {
      event.preventDefault();
      alert("Both title and post fields must be filled out.");
  }
});
function updateRecentPostSection() {
  // Send an AJAX request to the addPost.php file to fetch the latest post data
  fetch("addPost.php")
      .then(response => response.json())
      .then(latest_post => {
          // Create a new post element
          const post_element = document.createElement("div");
          post_element.classList.add("post");

          // Create the title element and add it to the post element
          const title_element = document.createElement("h2");
          title_element.classList.add("post-title");
          title_element.textContent = latest_post.title;
          post_element.appendChild(title_element);

          // Create the content element and add it to the post element
          const content_element = document.createElement("p");
          content_element.classList.add("post-content");
          content_element.textContent = latest_post.content;
          post_element.appendChild(content_element);

          // Create the created_at element and add it to the post element
          const created_at_element = document.createElement("p");
          created_at_element.classList.add("post-created-at");
          created_at_element.textContent = latest_post.created_at;
          post_element.appendChild(created_at_element);

          // Add the new post element to the recent posts section
          const recent_posts_element = document.getElementById("recent-posts");
          recent_posts_element.insertBefore(post_element, recent_posts_element.firstChild);
      })
      .catch(error => console.error(error));
}

// Call the updateRecentPostSection function every 10 seconds to update the recent post section automatically
setInterval(updateRecentPostSection, 10000);
