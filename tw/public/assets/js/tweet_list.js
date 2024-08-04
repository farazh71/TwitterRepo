document.addEventListener("DOMContentLoaded", () => {
  loadMoreTweets(0);
});
async function loadMoreTweets(offset) {
  const token = localStorage.getItem("jwtToken");
  if (!token) {
    console.error("No JWT token found in localStorage.");
    return;
  }

  try {
    const response = await fetch(`${baseUrl}/tweet-fetch-more/${offset}`, {
      method: "GET",
      headers: {
        Authorization: `Bearer ${token}`,
        "Content-Type": "application/json",
      },
    });

    if (!response.ok) {
      const error = await response.text();
      throw new Error(`Network response was not ok: ${error}`);
    }

    const tweets = await response.json();
    renderTweets(tweets);
  } catch (error) {
    console.error("Error fetching tweets:", error);
  }
}

function renderTweets(tweets) {
  const tweetPostList = document.getElementById("tweet-post-list");

  if (tweets.length === 0) {
    console.log("No more tweets to load.");
    return;
  }

  tweets.forEach((tweet) => {
    const tweetDiv = document.createElement("div");
    tweetDiv.classList.add("tweet-list-container");

    tweetDiv.innerHTML = `
        <div class="tweet-listing-profile-photo">
            <img src="${tweet.profile_photo_url}" alt="${
      tweet.Name
    }'s profile photo" style="width: 50px; height: 50px; border-radius: 50%;">
        </div>
        <div class="tweet-content">
            <div>
                <span class="tweetedByName">${tweet.Name}</span>
                <span class="timeAgo">${formatTimeAgo(tweet.created_at)}</span>
            </div>
            <div class="tweet-text-content">${tweet.content}</div>
            <div class="tweet-media-content">
                ${
                  tweet.media_type
                    ? `<img src="${tweet.media_url}" alt="Tweet media" style="width: 100%; height: 100%;">`
                    : ""
                }
            <div class="tweet-footer">
                <button class="comment-button" data-tweet-id="${
                  tweet.tweet_id
                }">
                    <i class="fa-solid fa-comment"></i> Comment
                </button>
            <button class="retweet-button ${
              tweet.is_retweeted ? "retweeted" : ""
            }" data-tweet-id="${tweet.tweet_id}">
                    <i class="fa fa-retweet"></i> Retweet ${tweet.retweet_count}
                </button>
                <button class="like-button ${
                  tweet.liked ? "liked" : ""
                }" data-tweet-id="${tweet.tweet_id}">
                    <i class="fa-solid fa-heart"></i> Like ${tweet.like_count}
                </button>
            </div>
             <div class="comment-section" id="comment-section-${
               tweet.tweet_id
             }" style="display: none;">
                    <div id="comment-listing-${tweet.tweet_id}"></div>
                    <div class="comment-section">
                        <textarea class="comment-input" placeholder="Write a comment..."></textarea>
                        <button class="submit-comment" data-tweet-id="${
                          tweet.tweet_id
                        }">Submit</button>
                    </div>
            </div>
            </div>
        </div>
    `;

    tweetPostList.appendChild(tweetDiv);
  });

  document.querySelectorAll(".comment-button").forEach((button) => {
    button.addEventListener("click", (e) => {
      const tweetId = e.target.dataset.tweetId;
      const commentSection = document.getElementById(
        `comment-section-${tweetId}`
      );
      commentSection.style.display =
        commentSection.style.display === "block" ? "none" : "block";
      loadComments(tweetId);
    });
  });

  document.querySelectorAll(".submit-comment").forEach((button) => {
    button.addEventListener("click", (e) => {
      const tweetId = e.target.dataset.tweetId;
      const commentInput = document.querySelector(
        `#comment-section-${tweetId} .comment-input`
      );
      submitComment(tweetId, commentInput.value);
    });
  });

  document.querySelectorAll(".like-button").forEach((button) => {
    button.addEventListener("click", (e) => {
      const tweetId = e.target.dataset.tweetId;
      toggleLike(tweetId);
    });
  });

  document.querySelectorAll(".retweet-button").forEach((button) => {
    button.addEventListener("click", (e) => {
      const tweetId = e.target.dataset.tweetId;
      retweet(tweetId);
    });
  });
}

async function retweet(tweetId) {
  const token = localStorage.getItem("jwtToken");
  if (!token) {
    console.error("No JWT token found in localStorage.");
    return;
  }

  try {
    const response = await fetch(`${baseUrl}/retweet`, {
      method: "POST",
      headers: {
        Authorization: `Bearer ${token}`,
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ tweet_id: tweetId }),
    });

    if (!response.ok) {
      const error = await response.text();
      throw new Error(`Network response was not ok: ${error}`);
    }

    console.log("Retweet successful.");

    // Update the UI to reflect the new retweet status
    const retweetButton = document.querySelector(
      `.retweet-button[data-tweet-id="${tweetId}"]`
    );
    const retweetCountElem = retweetButton.querySelector("span");

    let retweetCount = parseInt(retweetButton.textContent.match(/\d+/)[0]) || 0;
    retweetButton.innerHTML = `<i class="fa fa-retweet"></i> Retweet ${
      retweetCount + 1
    }`;
  } catch (error) {
    console.error("Error retweeting:", error);
  }
}

async function toggleLike(tweetId) {
  const token = localStorage.getItem("jwtToken");
  if (!token) {
    console.error("No JWT token found in localStorage.");
    return;
  }

  try {
    const response = await fetch(`${baseUrl}/tweet/like`, {
      method: "POST",
      headers: {
        Authorization: `Bearer ${token}`,
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ tweet_id: tweetId }),
    });

    if (!response.ok) {
      const error = await response.text();
      throw new Error(`Network response was not ok: ${error}`);
    }

    console.log("Like toggled successfully.");

    const likeButton = document.querySelector(
      `.like-button[data-tweet-id="${tweetId}"]`
    );
    const isLiked = likeButton.classList.toggle("liked");
    const likeCountElem = likeButton.querySelector("span");

    let likeCount = parseInt(likeButton.textContent.match(/\d+/)[0]);
    likeCount = isLiked ? likeCount + 1 : likeCount - 1;
    likeButton.innerHTML = `<i class="fa-solid fa-heart"></i> Like ${likeCount}`;
  } catch (error) {
    console.error("Error toggling like:", error);
  }
}

function formatTimeAgo(timestamp) {
  const now = new Date();
  const then = new Date(timestamp);
  const diffInMinutes = Math.floor((now - then) / (1000 * 60));

  if (diffInMinutes < 1) return "just now";
  if (diffInMinutes < 60) return `${diffInMinutes} minutes ago`;
  if (diffInMinutes < 1440)
    return `${Math.floor(diffInMinutes / 60)} hours ago`;
  return `${Math.floor(diffInMinutes / 1440)} days ago`;
}

async function submitComment(tweetId, comment) {
  const token = localStorage.getItem("jwtToken");
  if (!token) {
    console.error("No JWT token found in localStorage.");
    return;
  }

  try {
    const response = await fetch(`${baseUrl}/submit-comment`, {
      method: "POST",
      headers: {
        Authorization: `Bearer ${token}`,
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ tweet_id: tweetId, content: comment }),
    });

    if (!response.ok) {
      const error = await response.text();
      throw new Error(`Network response was not ok: ${error}`);
    }

    console.log("Comment submitted successfully.");
    loadComments(tweetId); // Refresh the comments list
  } catch (error) {
    console.error("Error submitting comment:", error);
  }
}

async function loadComments(tweetId) {
  try {
    const response = await fetch(`${baseUrl}/get-comments/${tweetId}`, {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    });

    if (!response.ok) {
      const error = await response.text();
      throw new Error(`Network response was not ok: ${error}`);
    }

    const comments = await response.json();
    comments && comments.length && renderComments(tweetId, comments);
  } catch (error) {
    console.error("Error loading comments:", error);
  }
}

function renderComments(tweetId, comments) {
  const commentsList = document.getElementById(`comment-listing-${tweetId}`);

  commentsList.innerHTML = "";

  comments.forEach((comment) => {
    const commentDiv = document.createElement("div");
    commentDiv.classList.add("comment-item");
    commentDiv.innerHTML = `
            <div class="comment-container">
                <div>
                    <span class="commentedByName">${comment.Name}</span>
                    <span class="commentTimeAgo">${formatTimeAgo(
                      comment.created_at
                    )}</span>
                </div>
                <div class="comment-text-content">${comment.content}</div>
            </div>
        `;
    commentsList.appendChild(commentDiv);
  });
}

document.getElementById("load-more").addEventListener("click", () => {
  const offset = document.querySelectorAll(".tweet-list-container").length;
  loadMoreTweets(offset);
});
