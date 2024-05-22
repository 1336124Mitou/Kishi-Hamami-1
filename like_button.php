<?php
$user_like_result = $kaitou->checkUserLike($user_id, $showAnswer['RepID']);
$user_liked = $user_like_result->rowCount() > 0;
?>

<div class="answer-info">
    <div class="interaction">
        <div class="date-and-like">
            <div class="like-container">
                <button id="likeButton<?= $showAnswer['RepID'] ?>" class="like-button <?= $user_liked ? 'liked' : '' ?>" onclick="likeAnswer(<?= $showAnswer['RepID'] ?>, '<?= $user_id ?>')">
                    <!-- SVG アイコン -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path class="heart-path" fill="<?= $user_liked ? 'pink' : 'white' ?>" stroke="<?= $user_liked ? 'none' : 'black' ?>" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                </button>
                <span id="likeCount<?= $showAnswer['RepID'] ?>"><?= $showAnswer['LNum'] ?></span>
            </div>
        </div>
    </div>
</div>

<script>
    function likeAnswer(repID, userId) {
        const likeButton = document.getElementById(`likeButton${repID}`);
        const heartPath = likeButton.querySelector('.heart-path');
        const likeCount = document.getElementById(`likeCount${repID}`);
        let liked = likeButton.classList.contains('liked');

        liked = !liked;
        likeButton.classList.toggle('liked', liked);

        // 更新された状態に基づいて色を変更する
        if (liked) {
            heartPath.setAttribute('fill', 'pink');
            heartPath.setAttribute('stroke', 'none');
        } else {
            heartPath.setAttribute('fill', 'white');
            heartPath.setAttribute('stroke', 'black');
        }

        likeCount.textContent = parseInt(likeCount.textContent) + (liked ? 1 : -1);

        fetch('like_update.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    answer_id: repID,
                    user_id: userId,
                    liked
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    likeCount.textContent = data.likes;
                } else {
                    // サーバー側でエラーが発生した場合、状態を元に戻す
                    liked = !liked;
                    likeButton.classList.toggle('liked', liked);

                    if (liked) {
                        heartPath.setAttribute('fill', 'pink');
                        heartPath.setAttribute('stroke', 'none');
                    } else {
                        heartPath.setAttribute('fill', 'white');
                        heartPath.setAttribute('stroke', 'black');
                    }

                    likeCount.textContent = parseInt(likeCount.textContent) + (liked ? 1 : -1);
                }
            });
    }
</script>