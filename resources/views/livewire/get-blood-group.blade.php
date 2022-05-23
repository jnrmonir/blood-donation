<div>
    <div class="card">
    <div class="row">
        <!-- .col-md-4 col-lg-3 col-sm-6 -->
        @foreach($blood_groups as $blood_group)
        <div class="col-md-4 col-xl-3 col-sm-6">
            <div class="hoverable-card text-center">
                <div class="card-header">
                    <a href="#">
                        <h4 class="text-uppercase mb-0">{{ $blood_group->full_name }}</h4>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
        <!-- /.col-md-4 col-lg-3 col-sm-6 -->
    </div>
    <!-- /.row -->
</div>
</div>
