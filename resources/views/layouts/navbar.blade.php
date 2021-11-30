<div class="col-md-3">
    <div class="list-group">
        <a href="{{ url('/') }}" class="list-group-item list-group-item-action {{ Request::is('/') ? 'active' : '' }}"><i class="fas fa-home"></i> Home</a>
        <a href="{{ route('member.index') }}" class="list-group-item list-group-item-action {{ Request::is('member*') ? 'active' : '' }}"><i class="fas fa-users"></i> All Members</a>
        <a href="{{ route('bookcategory.index') }}" class="list-group-item list-group-item-action"><i class="fas fa-list-alt"></i> Book Categories</a>
        <a href="{{ route('book.index') }}" class="list-group-item list-group-item-action {{ Request::is('book*') ? 'active' : '' }}"><i class="fas fa-book"></i> All Books</a>
        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-clipboard-list"></i> Issued Books</a>
        <a href="{{ route('admin.logout') }}" class="list-group-item list-group-item-action"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>
