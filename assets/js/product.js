import './app'
import axios from 'axios'

const $ = require('jquery')

console.log('start');
function getCalcData(event, form) {
    const activeInput = event?$(event.target):event;
    const formData = form.serializeArray();

    if(activeInput){
        activeInput.prop("readonly", true);
    }

    let params = new URLSearchParams();

    formData.forEach(function (data) {
        params.append(data.name, data.value)
    })

    axios({
        method: 'post',
        url: form.attr('action'),
        data: params
    }).then(function (response) {
        const result = response.data;
        $('#result').html(result.result).addClass('badge-success').removeClass('text-danger')
        if (result.status == 'error'){
            $('#result').addClass('text-danger').removeClass('badge-success')
        }
        if(activeInput) {
            activeInput.prop("readonly", false).focus();
        }
        console.log('end');
    })
        .catch(function (error) {
            const result = error.response.data;
            $('#result').html(result.result).addClass('badge-danger')
        });
}

getCalcData(null, $('#product'));

$('#product').on('input',function (event) {
    const form = $(this);
    getCalcData(event, form);
})

