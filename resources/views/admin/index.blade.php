<x-layout>
    <x-priloader />
    <!-- /.navbar -->
    <x-nav />

    <!-- Sidebar -->
    <x-sidebar />

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- /.content-header -->
        <x-header />

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <x-small-card num="100" title="Customers" color="bg-success" icon="ion-bag" />
                    <x-small-card num="200" title="Orders" color="bg-info" icon="ion-stats-bars" />
                    <x-small-card num="300" title="Posts" color="bg-danger" icon="ion-person-add" />
                    <x-small-card num="400" title="Categories" color="bg-warning" icon="ion-pie-graph" />
                </div>
                <!-- /.row -->
                <div class="row">
                    <x-card2  num="150" title="Posts" des="all aqbout post" color="bg-danger" icon="fa-bookmark"/>
                    <x-card2  num="450" title="Categories" des="aqbout Category" color="bg-success" icon="fa-thumbs-up"/>
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>


</x-layout>
