@foreach ($users as $user)
  <h1>Your name は {{$user->name}} . Your mail address は {{$user->email}}</h1>
@endforeach