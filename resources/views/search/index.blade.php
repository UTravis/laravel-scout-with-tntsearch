@extends('search.template.app')

    @section('body')
        
        <form action="" method="get" class="mt-5">
            <div class="form-group">
                <label for="">Search for <i class="fa fa-user" aria-hidden="true"></i> </label>
                <input type="text"
                class="form-control" name="search" id="search" aria-describedby="helpId" placeholder="Search user...">
                <small id="helpId" class="form-text text-muted">Just type your search</small>
            </div>
        </form>

        {{-- @if (request()->has('search')) --}}
            <ul class="list-group" id="searchResult"></ul>
            
            <div class="clear"></div>
            <div id="userDetail"></div>
        {{-- @endif --}}

        @if (session('status'))
            
            <table class="table table-striped table-inverse table-responsive">
                <thead class="thead-inverse">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>Country</th>
                        <th>Bio</th>
                    </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->age}}</td>
                                <td>{{$user->country}}</td>
                                <td>{{ mb_strimwidth($user->bio, 0, 50) }}</td> 
                            </tr>
                    </tbody>
            </table>

        @endif

        

        <script>
            $(document).ready(function(){
                $("#search").keyup(function(){
                    var search = $(this).val();
    
                    if(search != ""){

                        // alert(search);
    
                        $.ajax({
                            url:  "{{URL::to('/search/user')}}",
                            type: 'GET',
                            data: {
                                search: search
                            },
                            // dataType: 'json',
                            success:function(response){

                                console.log(response);
                            
                                var len = response.length;
                                $("#searchResult").empty();
                                for( var i = 0; i<len; i++){
    
                                    var id = response[i]['id'];
                                    var name = response[i]['name'];
                                 
                                    $("#searchResult").append("<a href='search/user/"+id+"' class='list-group-item list-group-item-action'>"+name+"</a>");
    
                                }
    
                                // binding click event to li
                                $("#searchResult li").bind("click",function(){
                                    setText();
                                });
    
                            },
                            error:function(response){
                                console.log(response);
                            }
                        });
    
                    }
                })
            })
        </script>
    @endsection




   