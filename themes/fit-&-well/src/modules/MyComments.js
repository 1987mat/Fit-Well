class MyComments {
  constructor() {
    this.editButton = document.querySelectorAll('.edit-btn');
    this.deleteButton = document.querySelectorAll('.delete-btn');
    this.updateButton = document.querySelectorAll('.update-btn');
    this.events();
  }

  events() {
    this.editButton.forEach((item) => {
      item.addEventListener('click', this.editComment.bind(this));
    });

    this.deleteButton.forEach((item) => {
      item.addEventListener('click', this.deleteComment);
    });

    this.updateButton.forEach((item) => {
      item.addEventListener('click', this.updateComment.bind(this));
    });
  }

  // METHODS
  editComment(e) {
    // Get clicked comment
    let comment = e.target.parentElement.parentElement;

    if (comment.dataset.state == 'editable') {
      this.makeCommentReadOnly(comment);
    } else {
      this.makeCommentEditable(comment);
    }
  }

  makeCommentEditable(comment) {
    // Change edit button to cancel button
    comment.querySelector('.edit-btn').innerHTML =
      '<i class="fa fa-times" aria-hidden="true"></i>Cancel';

    comment.querySelectorAll('input, textarea').forEach((item) => {
      item.readOnly = false;
      item.classList.add('edit-mode');
    });

    // Show Save Button
    comment.querySelector('.update-btn').classList.add('--visible');

    // Set data attribute editable
    comment.setAttribute('data-state', 'editable');
  }

  makeCommentReadOnly(comment) {
    // Change edit button to cancel button
    comment.querySelector('.edit-btn').innerHTML =
      '<i class="fa fa-pencil" aria-hidden="true"></i>Edit';

    comment.querySelectorAll('input, textarea').forEach((item) => {
      item.readOnly = true;
      item.classList.remove('edit-mode');
    });

    // Hide Save Button
    comment.querySelector('.update-btn').classList.remove('--visible');

    // Remove data attribute editable
    comment.removeAttribute('data-state', 'editable');
  }

  deleteComment(e) {
    // Get clicked comment
    let comment = e.target.parentElement.parentElement;

    // Send delete request
    let url =
      siteData.root_url + '/wp-json/wp/v2/comment/' + comment.dataset.id;

    fetch(url, {
      headers: {
        'X-WP-Nonce': siteData.nonce,
      },
      method: 'DELETE',
    })
      .then((response) => response.json())
      .then((data) => {
        // Delete li element from the page
        comment.remove();
        console.log('Congrats');
        console.log(data);
      })
      .catch((error) => console.log(error));
  }

  updateComment(e) {
    // Get clicked comment
    let comment = e.target.parentElement;

    // Send post request
    let url =
      siteData.root_url + '/wp-json/wp/v2/comment/' + comment.dataset.id;

    let ourUpdateComment = {
      title: comment.querySelector('.comment-input-field').value,
      content: comment.querySelector('.comment-body-field').value,
    };

    fetch(url, {
      headers: {
        'X-WP-Nonce': siteData.nonce,
        'Content-Type': 'application/json',
      },
      method: 'POST',
      body: JSON.stringify(ourUpdateComment),
    })
      .then((response) => response.json())
      .then((data) => {
        this.makeCommentReadOnly(comment);
        console.log('Congrats');
        console.log(data);
      })
      .catch((error) => console.log(error));
  }
}

export default MyComments;
