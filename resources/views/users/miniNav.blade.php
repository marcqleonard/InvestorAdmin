<div class="row d-md-none d-xs-block">
    <div class="col-md-12">
        <ul class="list-inline user-zone-nav text-center">
            <li class="list-inline-item p-2"><a href="{{ route('users.show', ['id' => $user->id]) }}" class="btn btn-link">Overview</a></li>
            <li class="list-inline-item p-2"><a href="{{ route('users.portfolio', ['id' => $user->id]) }}" class="btn btn-link">Portfolio</a></li>
            <li class="list-inline-item p-2"><a href="{{ route('users.history', ['id' => $user->id]) }}" class="btn btn-link">History</a></li>
            <li class="list-inline-item p-2"><a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-link">Edit</a></li>
            <li class="list-inline-item p-2"><a href="{{ route('users.dangerzone', ['id' => $user->id]) }}" class="btn btn-link">Danger Zone</a></li>
        </ul>
        <hr>
    </div>
</div>