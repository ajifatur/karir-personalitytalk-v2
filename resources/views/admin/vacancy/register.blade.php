<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://www.psikologanda.com/templates/qbs/bootstrap/style.min.css">
    <link rel="stylesheet" type="text/css" href="https://www.psikologanda.com/templates/qbs/bootstrap/homev2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css" integrity="sha256-8g4waLJVanZaKB04tvyhKu2CZges6pA5SUelZAux/1U=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://www.psikologanda.com/assets/css/login.css">
    <link rel="stylesheet" type="text/css" href="https://www.psikologanda.com/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha256-siyOpF/pBWUPgIcQi17TLBkjvNgNQArcmwJB8YvkAgg=" crossorigin="anonymous" />
    <title>Registrasi</title>
    <style type="text/css">
        .card {border-radius: 0;}
        .card-header span {display: inline-block; height: 12px; width: 12px; margin: 0px 5px; border-radius: 50%; background: rgba(0,0,0,.2);}
        .card-header span.active {background: #007bff!important;}
        .input-group-text {width: 40px;}
        .preloader {display: none; position: fixed; height: 100%; width: 100%; top: 0; right: 0; left: 0; bottom: 0; z-index: 9999; background: rgba(0,0,0,.55);}
        .preloader-animation {background-position: center; background-repeat: no-repeat; height: 100%;}
        .datepicker {z-index: 1040!important;}
    </style>
</head>
<body>
    <div id="sidebar-main"></div>
    <div id="navbar-main"></div>

    <div class="wrapper py-lg-5 py-md-3 pt-1">
        <div class="d-flex justify-content-center h-100">
            <div class="card col-md-9 border-0 shadow-sm" style="border-radius: .5em">
                <div class="card-body">
                    <form id="form" method="post" action="/">
                        {{ csrf_field() }}

                        <!-- Identitas Diri -->
                        <div class="row">
                            <div class="col-lg-2 col-md-3">
                                <p><strong>Identitas Diri</strong></p>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Nama Lengkap: <span class="text-danger">*</span></label>
                                        <input name="name" type="text" class="form-control form-control-sm {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}">
                                        @if($errors->has('name'))
                                        <div class="invalid-feedback">{{ ucfirst($errors->first('name')) }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Tempat Lahir: <span class="text-danger">*</span></label>
                                        <input name="birthplace" type="text" class="form-control form-control-sm {{ $errors->has('birthplace') ? 'is-invalid' : '' }}" value="{{ old('birthplace') }}">
                                        @if($errors->has('birthplace'))
                                        <div class="invalid-feedback">{{ ucfirst($errors->first('birthplace')) }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Tanggal Lahir: <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input name="birthdate" type="text" class="form-control form-control-sm {{ $errors->has('birthdate') ? 'is-invalid' : '' }}" value="{{ old('birthdate') }}" placeholder="dd/mm/yyyy">
                                        </div>
                                        @if($errors->has('birthdate'))
                                        <div class="invalid-feedback">{{ ucfirst($errors->first('birthdate')) }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Jenis Kelamin: <span class="text-danger">*</span></label>
                                        <select name="gender" class="form-control form-control-sm {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                                            <option value="" disabled selected>--Pilih--</option>
                                            <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>Laki-Laki</option>
                                            <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        @if($errors->has('gender'))
                                        <div class="invalid-feedback">{{ ucfirst($errors->first('gender')) }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Agama: <span class="text-danger">*</span></label>
                                        <select name="religion" class="form-control form-control-sm {{ $errors->has('religion') ? 'is-invalid' : '' }}">
                                            <option value="" disabled selected>--Pilih--</option>
                                            @foreach($religions as $religion)
                                            <option value="{{ $religion->id }}" {{ old('religion') == $religion->id ? 'selected' : '' }}>{{ $religion->name }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('religion'))
                                        <div class="invalid-feedback">{{ ucfirst($errors->first('religion')) }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>No. KTP:</label>
                                        <input name="identity_number" type="text" class="form-control form-control-sm {{ $errors->has('identity_number') ? 'is-invalid' : '' }}" value="{{ old('identity_number') }}">
                                        @if($errors->has('identity_number'))
                                        <div class="invalid-feedback">{{ ucfirst($errors->first('identity_number')) }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Status Hubungan: <span class="text-danger">*</span></label>
                                        <select name="relationship" class="form-control form-control-sm {{ $errors->has('relationship') ? 'is-invalid' : '' }}">
                                            <option value="" disabled selected>--Pilih--</option>
                                            @foreach($relationships as $relationship)
                                            <option value="{{ $relationship->id }}" {{ old('relationship') == $relationship->id ? 'selected' : '' }}>{{ $relationship->name }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('relationship'))
                                        <div class="invalid-feedback">{{ ucfirst($errors->first('relationship')) }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <!-- Contact -->
                        <div class="row">
                            <div class="col-lg-2 col-md-3">
                                <p><strong>Kontak</strong></p>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Email: <span class="text-danger">*</span></label>
                                        <input name="email" type="email" class="form-control form-control-sm {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}">
                                        @if($errors->has('email'))
                                        <div class="invalid-feedback">{{ ucfirst($errors->first('email')) }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>No. Telepon: <span class="text-danger">*</span></label>
                                        <input name="phone_number" type="text" class="form-control form-control-sm {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" value="{{ old('phone_number') }}">
                                        @if($errors->has('phone_number'))
                                        <div class="invalid-feedback">{{ ucfirst($errors->first('phone_number')) }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Alamat: <span class="text-danger">*</span></label>
                                        <textarea name="address" class="form-control form-control-sm {{ $errors->has('address') ? 'is-invalid' : '' }}" rows="3">{{ old('address') }}</textarea>
                                        @if($errors->has('address'))
                                        <div class="invalid-feedback">{{ ucfirst($errors->first('address')) }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <!-- History -->
                        <div class="row">
                            <div class="col-lg-2 col-md-3">
                                <p><strong>Riwayat Hidup</strong></p>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <div class="form-group">
                                    <label>Pendidikan Terakhir: <span class="text-danger">*</span></label>
                                    <textarea name="last_education" class="form-control form-control-sm {{ $errors->has('last_education') ? 'is-invalid' : '' }}" rows="3">{{ old('last_education') }}</textarea>
                                    @if($errors->has('last_education'))
                                    <div class="invalid-feedback">{{ ucfirst($errors->first('last_education')) }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Riwayat Pekerjaan:</label>
                                    <textarea name="job_experiences" class="form-control form-control-sm {{ $errors->has('job_experiences') ? 'is-invalid' : '' }}" rows="3">{{ old('job_experiences') }}</textarea>
                                    <small class="text-muted">Kosongi saja jika Anda belum memiliki riwayat pekerjaan</small>
                                    @if($errors->has('job_experiences'))
                                    <div class="invalid-feedback">{{ ucfirst($errors->first('job_experiences')) }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr>

                        <!-- <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label>Akun Sosial Media: <span class="text-danger">*</span></label>
                                <div class="input-group">
                                <select name="sosmed" class="col-4 form-control form-control-sm {{ $errors->has('akun_sosmed') ? 'border-danger' : '' }}">
                                    @if(!empty($array))
                                    <option value="Facebook" {{ $array['sosmed'] == 'Facebook' ? 'selected' : '' }}>Facebook</option>
                                    <option value="Twitter" {{ $array['sosmed'] == 'Twitter' ? 'selected' : '' }}>Twitter</option>
                                    <option value="Instagram" {{ $array['sosmed'] == 'Instagram' ? 'selected' : '' }}>Instagram</option>
                                    <option value="YouTube" {{ $array['sosmed'] == 'YouTube' ? 'selected' : '' }}>YouTube</option>
                                    @else
                                    <option value="Facebook" {{ old('sosmed') == 'Facebook' ? 'selected' : '' }}>Facebook</option>
                                    <option value="Twitter" {{ old('sosmed') == 'Twitter' ? 'selected' : '' }}>Twitter</option>
                                    <option value="Instagram" {{ old('sosmed') == 'Instagram' ? 'selected' : '' }}>Instagram</option>
                                    <option value="YouTube" {{ old('sosmed') == 'YouTube' ? 'selected' : '' }}>YouTube</option>
                                    @endif
                                </select>
                                <input name="akun_sosmed" type="text" class="form-control form-control-sm {{ $errors->has('akun_sosmed') ? 'is-invalid' : '' }}" placeholder="Masukkan Akun Sosmed" value="{{ !empty($array) ? $array['akun_sosmed'] : old('akun_sosmed') }}">
                                </div>
                                @if($errors->has('akun_sosmed'))
                                <small class="text-danger">
                                {{ ucfirst($errors->first('akun_sosmed')) }}
                                </small>
                                @endif
                            </div>
                        </div> -->
                        <div class="form-group mt-3">
                            <div class="row">
                                <div class="col-auto ml-auto">
                                    <button type="submit" class="btn btn-sm btn-primary rounded">Selanjutnya &raquo;</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="footer-main"></div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha256-bqVeqGdJ7h/lYPq6xrPv/YGzMEb6dNxlfiTUHSgRCp8=" crossorigin="anonymous"></script>
    <script src="https://psikologanda.com/assets/partials/template.js"></script>
    <script type="text/javascript">
        $(function(){
            // Show datepicker
            $('input[name=birthdate]').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true
            });
            
            // Button show datepicker
            $(document).on("click", ".btn-show-datepicker", function(e){
                e.preventDefault();
                $('input[name=birthdate]').focus();
            });
        
            // Show loader on submit
            $(document).on("submit", "#form", function(e){
                e.preventDefault();
                $(".preloader").show();
                $("#form")[0].submit();
            });
        });
    </script>
    <script type="text/javascript">
        $(document).on('click','#sidebarCollapse',function(e){
        e.preventDefault();
        $('#sidebar').hasClass('active') 
            ? $('#sidebar').removeClass('active') 
            : $('#sidebar').addClass('active');
        $(this).find('i').hasClass('ti-menu') 
            ? $(this).find('i').removeClass('ti-menu').addClass('ti-close') 
            : $(this).find('i').addClass('ti-menu').removeClass('ti-close');
        })

        $(document).on("click", "#sidebar > .sidebar-menu > .menu-label.sidebar-dropdown > a", function(e){
        e.preventDefault();
        $(this).parent(".menu-label").hasClass("active") 
            ? $(this).parent(".menu-label").removeClass("active") 
            : $(this).parent(".menu-label").addClass("active");
        })
    </script>
</body>
</html>