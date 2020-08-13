<section class="content">
  <div class="card card-warning">
    <div class="card-header">
      <h4 class="card-title">
        <i class="fas fa-chalkboard-teacher"></i>&nbsp;
          แก้ไขการติดตาม (Tracking Customer)
      </h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>

    <form name="form1" action="{{ action('ResearchCusController@update',[$tracking->Tracking_id, $type]) }}" method="post" id="formimage" enctype="multipart/form-data">
      @csrf
      @method('put')
      <div class="card-body text-sm">

        <div class="row">
          <div class="col-6">
            <div class="form-group row mb-0">
              <label class="col-sm-3 col-form-label text-right"><font color="red">วันที่ : </font></label>
              <div class="col-sm-8">
                <input type="date" name="DateTrack" class="form-control" value="{{ $tracking->Date_Tracking }}"/>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group row mb-1">
              <label class="col-sm-3 col-form-label text-right"><font color="red">สรุปสถานะ : </font></label>
              <div class="col-sm-8">
                <select name="StatusTrack" class="form-control" required>
                  <option value="" selected>--- เลือกสถานะ ---</option>
                  <option value="ติดตามต่อไป" {{ ($tracking->Status_Tracking === 'ติดตามต่อไป') ? 'selected' : '' }}>ติดตามต่อไป</option>
                  <option value="ยกเลิกการติดตาม" {{ ($tracking->Status_Tracking === 'ยกเลิกการติดตาม') ? 'selected' : '' }}>ยกเลิกการติดตาม</option>
                  <option value="ยกเลิกจอง" {{ ($tracking->Status_Tracking === 'ยกเลิกจอง') ? 'selected' : '' }}>ยกเลิกจอง</option>
                  <option value="ปิดการขาย/ส่งมอบ" {{ ($tracking->Status_Tracking === 'ปิดการขาย/ส่งมอบ') ? 'selected' : '' }}>ปิดการขาย/ส่งมอบ</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group row mb-0">
              <label class="col-sm-3 col-form-label text-right">บันทึกการติดตาม : </label>
              <div class="col-sm-8">
                <textarea name="FollowTrack" class="form-control" rows="3" placeholder="Enter ...">{{ $tracking->Follow_Tracking }}</textarea>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group row mb-0">
              <label class="col-sm-3 col-form-label text-right">หมายเหตุ : </label>
              <div class="col-sm-8">
                <textarea name="NoteTrack" class="form-control" rows="3" placeholder="Enter ...">{{ $tracking->Note_tracking }}</textarea>
              </div>
            </div>
          </div>
        </div>

        <br>        
        <div class="row">
          <div class="col-12">
            <div class="card-tools d-inline float-right">
              <button type="submit" class="delete-modal btn btn-success">
                <i class="fas fa-save"></i> บันทึก
              </button>
              <a class="delete-modal btn btn-danger" href="{{ URL::previous() }}">
                <i class="far fa-window-close"></i> ยกเลิก
              </a>
            </div>
          </div>
        </div>

        <input type="hidden" name="_method" value="PATCH"/>
      </div>
    </form>
  </div>
</section>

<script>
  $(function () {
    $('[data-mask]').inputmask()
  })
</script>


