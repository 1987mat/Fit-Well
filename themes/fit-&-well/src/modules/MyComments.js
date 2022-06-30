class MyComments {
  constructor() {
    if (document.querySelector('#my-comments')) {
      this.myComments = document.querySelector('#my-comments');
      this.events();
    }
  }

  events() {
    this.myComments.addEventListener('click', (e) => this.clickHandler(e));

    document
      .querySelector('.submit-comment-btn')
      .addEventListener('click', (e) => this.createNewComment(e));
  }

  clickHandler(e) {
    if (
      e.target.classList.contains('delete-btn') ||
      e.target.classList.contains('fa-trash-o')
    )
      this.deleteComment(e);

    if (
      e.target.classList.contains('edit-btn') ||
      e.target.classList.contains('fa-pencil') ||
      e.target.classList.contains('fa-times')
    )
      this.editComment(e);

    if (
      e.target.classList.contains('update-btn') ||
      e.target.classList.contains('fa-check')
    )
      this.updateComment(e);
  }

  findNearestParentLi(el) {
    let thisComment = el;
    while (thisComment.tagName != 'LI') {
      thisComment = thisComment.parentElement;
    }
    return thisComment;
  }

  editComment(e) {
    // Get clicked comment
    let comment = this.findNearestParentLi(e.target);

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
    let comment = this.findNearestParentLi(e.target);

    // Send delete request
    let url =
      siteData.root_url + '/wp-json/wp/v2/comment/' + comment.dataset.id;

    function handleErrors(response) {
      if (!response.ok) {
        throw Error(response.statusText);
      } else {
        return response.json();
      }
    }

    fetch(url, {
      headers: {
        'X-WP-Nonce': siteData.nonce,
      },
      method: 'DELETE',
    })
      .then(handleErrors)
      .then(function (response) {
        console.log('ok', response);
        comment.remove();
      })
      .catch(function (error) {
        console.log(error);
      });
  }

  updateComment(e) {
    // Get clicked comment
    let comment = this.findNearestParentLi(e.target);

    // Send post request
    let url =
      siteData.root_url + '/wp-json/wp/v2/comment/' + comment.dataset.id;

    let ourUpdateComment = {
      title: comment.querySelector('.comment-input-field').value,
      content: comment.querySelector('.comment-body-field').value,
    };

    function handleErrors(response) {
      if (!response.ok) {
        throw Error(response.statusText);
      } else {
        return response.json();
      }
    }

    // Reference to myComments
    const that = this;

    fetch(url, {
      headers: {
        'X-WP-Nonce': siteData.nonce,
        'Content-Type': 'application/json',
      },
      method: 'POST',
      body: JSON.stringify(ourUpdateComment),
    })
      .then(handleErrors)
      .then(function (response) {
        console.log('ok', response);
        that.makeCommentReadOnly(comment);
      })
      .catch(function (error) {
        console.log(error);
      });
  }

  createNewComment(e) {
    const parent = e.target.parentElement.parentElement;
    let title = parent.querySelector('.comment-title').value;
    let content = parent.querySelector('.comment-body').value;

    if (title !== '' && content !== '') {
      let ourNewComment = {
        title: title,
        content: content,
        status: 'publish',
      };

      let url = siteData.root_url + '/wp-json/wp/v2/comment/';

      async function newComment() {
        try {
          const response = await fetch(url, {
            headers: {
              'X-WP-Nonce': siteData.nonce,
              'Content-Type': 'application/json',
            },
            method: 'POST',
            body: JSON.stringify(ourNewComment),
          });

          const data = await response.text();

          // Check if the user reached the max number of comments
          if (data !== 'You have reached your comment limit.') {
            const result = JSON.parse(data);

            // Clear input fields
            parent.querySelector('.comment-title').value = '';
            parent.querySelector('.comment-body').value = '';

            // Add the new comment to the list
            let newComment = document.createElement('li');
            newComment.innerHTML = `
          <div class="comment-top">
            <input class="comment-input-field" readonly value="${result.title.raw}">
            <button class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</button>
            <button class="delete-btn"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</button>
          </div>
          <textarea class="comment-body-field" readonly>${result.content.raw}</textarea>
          <button class="update-btn"><i class="fa fa-check" aria-hidden="true"></i>Save</button>`;
            newComment.dataset.id = result.id;
            document.querySelector('#my-comments').prepend(newComment);
          } else {
            // Show message alert
            document
              .querySelector('.comment-limit-message')
              .classList.add('visible');
            setTimeout(() => {
              document
                .querySelector('.comment-limit-message')
                .classList.remove('visible');
            }, 5000);
          }
        } catch {
          alert('Sorry! Something went wrong. Try again later.');
        }
      }

      newComment();
    } else {
      // Show message alert
      parent.querySelector('.message').innerHTML = 'Please fill both fields.';
      setTimeout(() => {
        parent.querySelector('.message').innerHTML = '';
      }, 2000);
    }
  }
}

export default MyComments;
