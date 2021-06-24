@if($type == 1) {{-- popup แก้ไขรายการซ่อม --}}
<form name="form1" method="post" action="{{ action('DatacarController@updateMechanic',$dataRepair->Repair_id) }}" enctype="multipart/form-data">
@csrf
@method('put')
    <div class="modal-content">
        <div class="modal-header bg-primary">
        <div class="col text-center">
            <h5 class="modal-title"><i class="fas fa-gears"></i> เเก้ไขรายการซ่อม</h5>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        </div>
        <div class="modal-body">
        <div class="row mb-2">
            <div class="col-md-2"></div>
            <div class="col-md-6">
            วันที่
            <input type="date" name="DateList" value="{{$dataRepair->Repair_date}}" class="form-control" />
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-2"></div>
            <div class="col-md-9">
            รายการอะไหล่
            <input type="text" name="RepairList" value="{{$dataRepair->Repair_list}}" class="form-control" />
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-2"></div>
            <div class="col-md-3">
            จำนวน
            <input type="number" name="RepairAmount" value="{{$dataRepair->Repair_amount}}" class="form-control" />
            </div>
            <div class="col-md-3">
            หน่วย
            <input type="text" id="RepairUnit" name="RepairUnit" value="{{$dataRepair->Repair_unit}}" class="form-control"/>
            </div>
            <div class="col-md-3">
            ราคา
            <input type="number" name="RepairPrice" value="{{$dataRepair->Repair_price}}" class="form-control"/>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-9">
            รายละเอียดการซ่อม
            <textarea type="text" name="RepairDetail" class="form-control" rows="3">{{$dataRepair->Repair_detail}}</textarea>
            </div>
        </div>
        <hr>
        </div>
        <input type="hidden" name="_method" value="PATCH"/>
        <input type="hidden" name="type" value="2">

        <div align="center">
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> อัพเดท</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i> ยกเลิก</button>
        </div>
        <br>
    </div>
</form>
@endif