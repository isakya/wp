import $ from 'jquery';
class MyNotes {
    constructor() {
        this.events()
    }

    events() {
        $('.delete-note').on('click', this.deleteNote)
    }

    // method will go here
    deleteNote() {
        alert('you click')
    }
}

export default MyNotes;