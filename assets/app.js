// /*
//  * Welcome to your app's main JavaScript file!
//  *
//  * This file will be included onto the page via the importmap() Twig function,
//  * which should already be in your base.html.twig.
//  */
// console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉')
//

document.addEventListener('DOMContentLoaded', () => {
    new App();
});

class App {
    constructor() {
        this.handleCommentForm();
    }

    handleCommentForm() {
        const commentForm = document.querySelector('form.comment-form');
        if (null === commentForm) {
            return;
        }
        commentForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const response = await fetch('/ajax/comments', {
                method: 'post',
                body: new FormData(e.target)
            })
            if (!response.ok) {
                return;
            }
            const json = await response.json();
            if (json.code === 'COMMENT_ADDED_SUCCESSFULLY') {
                const commentList = document.querySelector('.comment-list');
                const commentCount = document.querySelector('.comment-count');
                const commentContent = document.querySelector('#comment_content');
                commentList.insertAdjacentHTML('beforeend', json.message);
                commentList.lastElementChild.scrollIntoView();
                commentCount.innerText = json.numberOfComments;
                commentContent.value = '';
            }
        });
    }
}