<dialog class="image-options-dialog" id="image-options-dialog" aria-labelledby="image-options-title">
    <form method="dialog" class="image-options-content">
        <button class="image-options-close" type="submit" aria-label="Close">&times;</button>
        <h2 id="image-options-title">Profile picture</h2>
        <p id="image-options-description">What would you like to do with this image?</p>
        <div class="image-options-actions">
            <a id="view-full-image" class="image-options-button" href="#" target="_blank" rel="noopener">View full image</a>
            <a id="download-image" class="image-options-button image-options-button--download" href="#">Download image</a>
        </div>
    </form>
</dialog>

<script>
    const imageOptionsDialog = document.getElementById('image-options-dialog');
    const viewFullImageLink = document.getElementById('view-full-image');
    const downloadImageLink = document.getElementById('download-image');
    const imageOptionsDescription = document.getElementById('image-options-description');

    document.querySelectorAll('.profile-picture-button').forEach((button) => {
        button.addEventListener('click', () => {
            const studentName = button.dataset.studentName;
            viewFullImageLink.href = button.dataset.imageUrl;
            downloadImageLink.href = button.dataset.downloadUrl;
            imageOptionsDescription.textContent = `What would you like to do with ${studentName}'s profile picture?`;
            imageOptionsDialog.showModal();
        });
    });
</script>