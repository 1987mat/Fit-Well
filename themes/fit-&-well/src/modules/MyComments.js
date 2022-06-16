class MyComments {
  constructor() {
    this.editButton = document.querySelectorAll('.edit-comment');
    this.deleteButton = document.querySelectorAll('.delete-comment');
    this.events();
  }

  events() {
    this.editButton.forEach((item) => {
      item.addEventListener('click', this.editComment);
    });

    this.deleteButton.forEach((item) => {
      item.addEventListener('click', this.deleteComment);
    });
  }

  // Methods
  editComment(e) {
    // Get clicked comment
    let comment = e.target.parentElement.parentElement;

    // Remove readonly attribute
    comment.querySelectorAll('input, textarea').forEach((item) => {
      item.readOnly = false;
      item.classList.add('edit-mode');
    });

    // Show Save Button
    comment.querySelector('.update-comment').style.display = 'block';

    // Send  request
    //   let url =
    //     siteData.root_url + '/wp-json/wp/v2/comment/' + comment.dataset.id;

    //   fetch(url, {
    //     headers: {
    //       'X-WP-Nonce': siteData.nonce,
    //     },
    //     method: 'PUT',
    //   })
    //     .then((response) => response.json())
    //     .then((data) => console.log(data))
    //     .catch((error) => console.log(err));
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
        comment.remove();
        console.log('Congrats');
        console.log(data);
      })
      .catch((error) => console.log(error));
  }
}

export default MyComments;
