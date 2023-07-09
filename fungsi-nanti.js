// fungsi untuk menambah kolom pertanyaan

$('#addForm').click(function () {
  let inputCount = parseInt($('.jmlh').val());
  let inputKuisType = $('.form-select').val();
  let inputForm = '';
  let label = '';
  if (inputCount > 0 && inputKuisType != '') {
    for (let i = 0; i < inputCount; i++) {
      inputForm += ` 
                <label for="exampleInputText" class="form-label ">Pertanyaan ${i + 1}</label>

                      <input type="text" class="form-control kuis" id="exampleInputText" name="item_pertanyaan${i}"><br>
                    `;
    }
    $('.form-select').attr('disabled', 'disabled');
    $('#labelPlace').html(label);
    $('#inputPlace').html(inputForm);
    $('#submitForm').prop('disabled', false);
    // $(this).prop('disabled', true);
  } else {
    Swal.fire({
      position: 'top',
      icon: 'error',
      text: 'Silahkan Lengkapi Form',
    });
    $('.jmlh').addClass('border border-danger ');
    $('.form-select').addClass('border border-danger');
  }
});
