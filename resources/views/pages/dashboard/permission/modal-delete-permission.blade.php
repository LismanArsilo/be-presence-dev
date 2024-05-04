<!-- Modal -->
<div class="modal fade" id="modal-danger" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border border-bottom">
                <h5 class="modal-title text-danger" id="exampleModalCenterTitle">Permission Delete</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body contentDelete">
                {{-- <ion-icon name="alert-circle-outline" class="iconModalDelete"></ion-icon> --}}
                <p class="">Are Your Sure Deleted ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="btn-delete-confirm">Delete</button>
            </div>
        </div>
    </div>
</div>
