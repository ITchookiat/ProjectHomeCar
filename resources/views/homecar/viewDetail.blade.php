
<section class="content">
  <div class="card card-warning">
    <div class="card-header">
      <h4 class="card-title">
        <i class="fas fa-car"></i>&nbsp;
        เทียบราคารถยนต์มือ 2
      </h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>

    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Alert!</h4>
      <strong>สำเร็จ!</strong> {{ session()->get('success') }}
    </div>
    @endif

    <div class="card-body text-sm">
      <div class="row">
        <div class="col-4">
          <select name="BrandCar" id="BrandCar" class="form-control BrandCar">
            <option value="" selected>--- เลือกยี่ห้อรถ ---</option>
              @foreach ($data as $item)
                <option value="{{ $item->Brand_Car }}">{{ $item->Brand_Car}}</option>
              @endforeach
          </select>
        </div>
        <div class="col-4">
          <select name="VersionCar" id="VersionCar" class="form-control VersionCar">
            <option value="" selected>--- เลือกรุ่นรถ ---</option>
          </select>
        </div>
        <div class="col-4">
          <select name="YearCar" id="YearCar" class="form-control YearCar">
            <option value="" selected>--- ปีรถ ---</option>
          </select>
        </div>
      </div>
      
      <br>
      <div class="row">
        <div class="col-12">
          <div id="ShowData"></div>
        </div>
      </div>

        {{csrf_field()}}
    </div>
  </div>
</section>

<script type="text/javascript">
  $('.BrandCar').change(function() {
    if ($(this).val() != '') {
      
      var select = $(this).val();
      // console.log(select);
      var _token = $('input[name="_token"]').val();

      $.ajax({
        url:"{{ route('datacar.SearchData', 1) }}",
        method:"POST",
        data:{select:select,_token:_token},

        success:function(result){ //เสร็จแล้วทำอะไรต่อ
          $('.VersionCar').html(result);
        }
      })
    }
  });

  $('.VersionCar').change(function() {
    if ($(this).val() != '') {

      var select1 = $(this).val();
      var _token = $('input[name="_token"]').val();

      $.ajax({
        url:"{{ route('datacar.SearchData', 2) }}",
        method:"POST",
        data:{select1:select1,_token:_token},

        success:function(result){ //เสร็จแล้วทำอะไรต่อ
          $('.YearCar').html(result);
        }
      })
    }
  });

  $('.YearCar').change(function() {
    if ($(this).val() != '') {

      var select1 = $('#VersionCar').val();
      var select2 = $(this).val();
      var _token = $('input[name="_token"]').val();

      $.ajax({
        url:"{{ route('datacar.SearchData', 3) }}",
        method:"POST",
        data:{select1:select1,select2:select2,_token:_token},

        success:function(result){ //เสร็จแล้วทำอะไรต่อ
          $('#ShowData').html(result);
        }
      })
    }
  });

  $('.BrandCar').change(function() {
    if ($(this).val() != '') {
      
      var select = $(this).val();
      // console.log(select);
      var _token = $('input[name="_token"]').val();

      $.ajax({
        url:"{{ route('datacar.SearchData', 4) }}",
        method:"POST",
        data:{select:select,_token:_token},

        success:function(result){ //เสร็จแล้วทำอะไรต่อ
          $('#ShowData').html(result);
        }
      })
    }
  });

  $('.VersionCar').change(function() {
    if ($(this).val() != '') {

      var brand = $('#BrandCar').val();
      var version = $(this).val();
      var _token = $('input[name="_token"]').val();

      $.ajax({
        url:"{{ route('datacar.SearchData', 5) }}",
        method:"POST",
        data:{brand:brand,version:version,_token:_token},

        success:function(result){ //เสร็จแล้วทำอะไรต่อ
          $('#ShowData').html(result);
        }
      })
    }
  });

</script>

