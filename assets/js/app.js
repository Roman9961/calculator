import '../../node_modules/bootstrap/dist/css/bootstrap.min.css'
import '../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js'
import axios from 'axios'
import '../sass/main.sass'

$('#loginModal').on('show.bs.modal', function (e) {

    const modal =$(this);
    console.log(modal)
    axios({
        method: 'get',
        url: '/login'
    }).then(function (response) {

        $('#loginModalBody').html(response.data)
    })
    .catch(function (error) {
        $('#myModal').modal('hide')

    });
})


$('body').on('submit', 'form', function (event) {

    event.preventDefault()
    const form = $(event.currentTarget);
    const formData = form.serializeArray();

    let params = new URLSearchParams();

    formData.forEach(function (data) {
        params.append(data.name, data.value)
    })

    axios({
        method: 'post',
        url: form.attr('action'),
        data: params
    }).then(function (response) {
        if(response.data === 'reload'){
            window.location.reload();
        }
    })
    .catch(function (error) {
        console.log(error)
        $('#loginModalBody').html(error.response.data)
    });
})
