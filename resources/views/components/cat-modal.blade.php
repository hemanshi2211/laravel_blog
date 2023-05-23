
<div class="modal fade" id="{{$modalId}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> {{$title}} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="container">
                        <form action="" id="form-{{$modalId}}">

                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" id="name-{{$bName}}" class="form-control" placeholder=""
                                    aria-describedby="helpId">
                            </div>
                            <p class="text-red " id="{{$errorId}}"></p>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status-{{$bName}}" id="status"
                                        value="0" checked>
                                    Active
                                </label> <br />
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status-{{$bName}}" id="status"
                                        value="1">
                                    Inactive
                                </label>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="{{$bType}}" class="btn btn-primary {{$bClass}} "> {{ $bName }} </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
