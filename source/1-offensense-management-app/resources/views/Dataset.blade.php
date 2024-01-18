<!DOCTYPE html>

<html>

    <head>
        <title>Bad Word Predictor</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>

    <body>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Predicted Data<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/dataset">Words Dataset</a>
                    </li>
                </ul>
            </div>
        </nav>


        <div class="container">

            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="jumbotron">
                        <h1 class="display-4" style="text-align: center;">Add new words</h1>
                        <hr class="my-4">

                        <form>

                            <div class="form-label-group">
                                <input type="text" id="word" class="form-control" name="word" placeholder="Enter a word" required>
                                <br>
                                <a href="#" id="btn" class="btn btn-success btn-lg btn-block">Add to data</a>
                            </div>

                        </form>

                    </div>

                    <div id="DataTable">
    
                        <table class="table table-bordered table-hover" style="background-color:#f5f2ed;">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Word</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Data as $key=> $Data)
                                    <tr>
                                        <th>{{++$key}}</th>
                                        <td>{{$Data->word}}</td>
                                        <td><a onclick="return confirm('Do you want to delete this?. Are you sure?')" href="delete_word/{{$Data->auto_id}}"  class="btn btn-danger col-md-8">Delete</a></td>
                                    </tr>
                                @endforeach
                    
                            </tbody>
                        </table>
                
                    </div>   
                </div>
                    
            <div>


        </div>

        <script>

            document.getElementById("btn").onclick = function(){

                var word_data = document.getElementById("word").value;
                var hr = document.getElementById("btn").href = "add_word/"+word_data;
                

            }

        </script>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>

</html>