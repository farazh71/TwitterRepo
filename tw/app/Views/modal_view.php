<!-- app/Views/modal_view.php -->
<div id="tweet-modal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>New Tweet</h2>
            <span class="close-btn">&times;</span>
        </div>
        <div class="modal-body">
            <div id="tweet-profile-photo"><i class="fa-brands fa-twitter fa-2xl"></i></div>
            <textarea id="tweet-text" placeholder="What's happening?" maxlength="240"></textarea>
        </div>
        <div id="word-counter">0/240</div>
        <div class="modal-uploads">
            <div class="video-upload">
                <label for="modal-video-file"><i class="fa-solid fa-video"></i></label>
                <input id="modal-video-file" type="file" accept="video/*" style="display: none;" />
            </div>
            <div class="image-upload">
                <label for="modal-image-file"><i class="fa-solid fa-image"></i></label>
                <input id="modal-image-file" type="file" accept="image/*" style="display: none;" />
            </div>
            <div class="audio-upload">
                <label for="modal-audio-file"><i class="fa-solid fa-file-audio"></i></label>
                <input id="modal-audio-file" type="file" accept="audio/*" style="display: none;" />
            </div>
        </div>
        <div class="modal-actions">
            <button class="cancel-btn">Cancel</button>
            <button class="tweet-btn">Tweet</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById("tweet-modal");
        const btn = document.querySelector(".action-btn");
        const span = document.querySelector(".close-btn");
        const cancelBtn = document.querySelector(".cancel-btn");
        const tweetText = document.getElementById("tweet-text");
        const wordCounter = document.getElementById("word-counter");
        const tweetBtn = document.querySelector(".tweet-btn");

        // Open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // Close the modal when the user clicks on <span> (x)
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Close the modal when the user clicks on the cancel button
        cancelBtn.onclick = function() {
            modal.style.display = "none";
        }

        // Close the modal when the user clicks anywhere outside of the modal
        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        }

        // Update the word counter as the user types
        tweetText.addEventListener('input', function() {
            const currentLength = tweetText.value.length;
            wordCounter.textContent = `${currentLength}/240`;
        });

        // File upload handlers
        document.getElementById('modal-video-file').addEventListener('change', function() {
            resetOtherFileInputs('modal-video-file');
        });

        document.getElementById('modal-image-file').addEventListener('change', function() {
            resetOtherFileInputs('modal-image-file');
        });

        document.getElementById('modal-audio-file').addEventListener('change', function() {
            resetOtherFileInputs('modal-audio-file');
        });

        // Handle tweet button click
        tweetBtn.addEventListener('click', function() {
            if (tweetText.value.trim() === '') {
                alert('Tweet text is mandatory.');
                return;
            }

            const videoFile = document.getElementById('modal-video-file').files[0];
            const imageFile = document.getElementById('modal-image-file').files[0];
            const audioFile = document.getElementById('modal-audio-file').files[0];

            let file;
            let mediaType;

            if (videoFile) {
                file = videoFile;
                mediaType = 'video';
            } else if (imageFile) {
                file = imageFile;
                mediaType = 'image';
            } else if (audioFile) {
                file = audioFile;
                mediaType = 'audio';
            }

            if (file) {
                uploadTweetWithMedia(file, tweetText.value, mediaType);
            } else {
                uploadTweetWithoutMedia(tweetText.value);
            }
        });

        function resetOtherFileInputs(activeInputId) {
            ['modal-video-file', 'modal-image-file', 'modal-audio-file'].forEach(id => {
                if (id !== activeInputId) {
                    document.getElementById(id).value = '';
                }
            });
        }
    });

    function uploadTweetWithMedia(file, tweetText, mediaType) {
        var formData = new FormData();
        formData.append('content', tweetText);
        formData.append('media_type', mediaType);
        formData.append('media', file);

        var token = localStorage.getItem('jwtToken');
        if (!token) {
            alert('No JWT token found. Please log in.');
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://localhost:8081/tweet/upload', true);
        xhr.setRequestHeader('Authorization', 'Bearer ' + token);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 201) { // Changed to 201 for Created
                    alert('Tweet uploaded successfully.');
                    document.getElementById('tweet-modal').style.display = 'none';
                } else if (xhr.status === 401) {
                    alert('Unauthorized. Please log in again.');
                    window.location.href = 'login';
                } else {
                    alert('Failed to upload tweet.');
                }
            }
        };

        xhr.send(formData);
    }

    function uploadTweetWithoutMedia(tweetText) {
        var formData = new FormData();
        formData.append('content', tweetText);

        var token = localStorage.getItem('jwtToken');
        if (!token) {
            alert('No JWT token found. Please log in.');
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://localhost:8081/tweet/upload', true);
        xhr.setRequestHeader('Authorization', 'Bearer ' + token);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 201) { // Changed to 201 for Created
                    alert('Tweet uploaded successfully.');
                    document.getElementById('tweet-modal').style.display = 'none';
                } else if (xhr.status === 401) {
                    alert('Unauthorized. Please log in again.');
                    window.location.href = 'login';
                } else {
                    alert('Failed to upload tweet.');
                }
            }
        };

        xhr.send(formData);
    }
</script>
