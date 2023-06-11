<div class="row mx-2">
    <div class="col-md-12 fw-bold fs-3 text-uppercase">kuisioner</div>
</div>
<div class="mt-4">
    <hr class="dropdown-divider" />
</div>

<div class="row-justify-content-center ">
    <button type="button" class="btn  mx-3 my-3" id="callModalAddKuisioner" data-toggle="tooltip" data-placement="top" title="Tambah data baru"><i class="fas fa-plus"></i> Tambah Kuisioner</button>
    <!-- modals -->
    <div class="modal mt-4 mx-auto" tabindex="-1" id="modalShow" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" id="headerModal">
                    <h5 class="modal-title" id="modalTittle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-1 pb-0" id="bdModalKuisioner"></div>
                <div class="modal-footer bg-custom mt-3">
                    <p style="color:#777474;">&copy; <?php echo date("Y") ?> DarrellHF</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end modals -->
    <div class="col-md-12">
        <div class="card mx-3" width="400px">
            <div class="card-body" id="load-kuis">
                <!-- Tabel -->
                <div class="tabel" id="load-tabel"></div>
                <!-- end Tabel -->
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        // LOAD TABEL
        $('#load-tabel').load('kuisioner/tabel.php');

        // LOAD FORM INPUT
        $('#callModalAddKuisioner').on('click', function(event) {
            event.preventDefault();
            $('#modalShow').modal('show');
            $('#modalTittle').html('Tambah Data Baru');
            $('#bdModalKuisioner').text('loading...');
            $('#bdModalKuisioner').load('kuisioner/form-input.php');
            $('#headerModal').removeClass();
            $('#headerModal').addClass('modal-header bg-custom text-white');
        });


    })
</script>