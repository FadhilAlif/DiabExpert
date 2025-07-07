<body>
    @include('admin.layouts.head')
    @include('admin.layouts.header')

    <div class="d-flex" style="min-height: 100vh;">
        {{-- Sidebar --}}
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="width: 250px;">
            @include('admin.layouts.sidebar')
        </aside>

        {{-- Konten --}}
        <div class="flex-grow-1">
            @include('admin.layouts.content')
        </div>
    </div>
    @include('admin.layouts.footer')
</body>
