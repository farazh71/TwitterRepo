document.addEventListener('DOMContentLoaded', () => {
    // Initial fetch when the page loads
    loadMoreTweets(0);
});

// Function to load more tweets
async function loadMoreTweets(offset) {
    const token = localStorage.getItem('jwtToken');
    if (!token) {
        console.error('No JWT token found in localStorage.');
        return;
    }

    try {
        const response = await fetch(`${baseUrl}/tweet-fetch-more/${offset}`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            const error = await response.text(); // Get error message
            throw new Error(`Network response was not ok: ${error}`);
        }

        const tweets = await response.json();
        renderTweets(tweets);

    } catch (error) {
        console.error('Error fetching tweets:', error);
    }
}

// Function to render tweets
function renderTweets(tweets) {
    const tweetPostList = document.getElementById('tweet-post-list');
    
    if (tweets.length === 0) {
        console.log('No more tweets to load.');
        return;
    }

    tweets.forEach(tweet => {
        const tweetDiv = document.createElement('div');
        tweetDiv.classList.add('tweet-list-container');

        tweetDiv.innerHTML = `
            <div class="tweet-listing-profile-photo">
                <img src="${tweet.profile_photo_url}" alt="${tweet.Name}'s profile photo" style="width: 50px; height: 50px; border-radius: 50%;">
            </div>
            <div class="tweet-content">
                <div>
                    <span class="tweetedByName">${tweet.Name}</span>
                    <span class="timeAgo">${formatTimeAgo(tweet.created_at)}</span>
                </div>
                <div class="tweet-text-content">${tweet.content}</div>
                <div class="tweet-media-content">
                    ${tweet.media_type ? `<img src="${tweet.media_url}" alt="Tweet media" style="width: 100%;">` : ''}
                </div>
            </div>
            <div id="tweet-footer"></div>
        `;

        tweetPostList.appendChild(tweetDiv);
    });
}

// Function to format time ago
function formatTimeAgo(timestamp) {
    const now = new Date();
    const then = new Date(timestamp);
    const diffInMinutes = Math.floor((now - then) / (1000 * 60));

    if (diffInMinutes < 1) return 'just now';
    if (diffInMinutes < 60) return `${diffInMinutes} minutes ago`;
    if (diffInMinutes < 1440) return `${Math.floor(diffInMinutes / 60)} hours ago`;
    return `${Math.floor(diffInMinutes / 1440)} days ago`;
}

// Event listener for the "Load More" button
document.getElementById('load-more').addEventListener('click', () => {
    const offset = document.querySelectorAll('.tweet-list-container').length;
    loadMoreTweets(offset);
});
