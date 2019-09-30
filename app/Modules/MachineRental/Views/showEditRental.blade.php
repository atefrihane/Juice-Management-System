@extends('General.layoutStore') @section('pageTitle', 'Modifier une location') @section('content')


<div class="content-wrapper">

    <section class="content-header">

        {{ Breadcrumbs::render('detailEditMachine',$rental->machine->code) }}
    </section>

    <section class="content">
        <div class="row">
            <div class="container" id="app">

              <machine-rent-update> </machine-rent-update>

                <!-- /.col -->
            </div>

        </div>

    </section>

</div>



<script>
var data = {
    rental:{!! $rental !!},
    machine:{!! $rental->machine !!},
    bacs:{!! $rental->machine->bacs !!},
    company:{!! $rental->store->company !!},
    store:{!! $rental->store !!},
    userId:{!! Auth::id() !!}

}    

</script>

@endsection
