<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Sidebar
        </div>

        <div class="card-body">
            <div class="list-group">
                <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action">
                    Users
                </a>
                <a href="{{ route('roles.index') }}" class="list-group-item list-group-item-action">
                    Roles
                </a>
                <a href="{{ route('permissions.index') }}" class="list-group-item list-group-item-action">
                    Permissions
                </a>
            </div>
        </div>
    </div>
</div>
