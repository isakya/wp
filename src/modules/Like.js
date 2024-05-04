import $ from 'jquery'
class Like {
    constructor() {
        this.events()
    }

    events() {
        $('.like-box').on('click', this.ourClickDispatcher.bind(this))
    }

    // methods
    ourClickDispatcher(e) {
        var currentLikeBox = $(e.target).closest('.like-box') // 从子元素找到父元素
        if(currentLikeBox.data('exists') == 'yes') {
            this.deleteLike(currentLikeBox)
        } else {
            this.createLike(currentLikeBox)
        }
    }

    createLike(currentLikeBox) {
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce); // WP验证登录用户用的随机字符串
            },
            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            type: 'POST',
            data: {'professorId': currentLikeBox.data('professor')},
            success: (response) => {
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            },
        })
    }

    deleteLike(currentLikeBox) {
        $.ajax({
            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            type: 'DELETE',
            success: (response) => {
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            },
        })
    }
}

export default Like;