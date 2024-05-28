<?php
// $user_like_result = $kaitou->checkUserLike($_SESSION['userId'], $showAnswer['RepID']);
// $user_liked = $user_like_result->rowCount() > 0;

$liked = $likes->liked($showAnswer['RepID'], $_SESSION['userId']);
?>

<div class="answer-info">
    <div class="interaction">
        <div class="date-and-like">
            <div class="like-container">
                <button id="likeButton<?= $showAnswer['RepID'] ?>" class="like-button <?= $liked ? 'liked' : '' ?>" onclick="likeAnswer(<?= $showAnswer['RepID'] ?>, '<?= $_SESSION['userId'] ?>')">
                    <!-- SVG アイコン -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path class="heart-path" fill="<?= $liked ? 'pink' : 'white' ?>" stroke="<?= $liked ? 'none' : 'black' ?>" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                </button>
                <span id="likeCount<?= $showAnswer['RepID'] ?>"><?= $showAnswer['LNum'] ?></span>
            </div>
        </div>
    </div>
</div>

<script>
    function likeAnswer(repID, userId) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "likeRepadd.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    document.getElementById('likeCount' + repID).innerText = response.newLikeCount;

                    <?php $liked = $likes->liked($showAnswer['RepID'], $_SESSION['userId']); ?>
                    var likeButton = document.getElementById('likeButton' + repID);
                    var heartPath = likeButton.querySelector('.heart-path');
                    if (response.liked) {
                        heartPath.setAttribute('fill', 'pink');
                        heartPath.setAttribute('stroke', 'none');
                        likeButton.classList.add('liked');
                    } else {
                        heartPath.setAttribute('fill', 'white');
                        heartPath.setAttribute('stroke', 'black');
                        likeButton.classList.remove('liked');
                    }
                } else {
                    console.error("Error: " + response.message);
                }
            } else if (xhr.readyState === 4) {
                console.error("Error: " + xhr.status + " " + xhr.statusText);
            }
        };
        xhr.send("ReplyID=" + encodeURIComponent(repID) + "&UserID=" + encodeURIComponent(userId));
    }
</script>