<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello World</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

    @include('sweetalert::alert')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4" style="font-family:Potta One ;">Whatsap Blast <small class="text-muted" style="font-size: 20px;">By Seseorang</small> </h1>
            <p class="lead">Aplikasi untuk mengirim broadcast Whatsapp</p>
        </div>
    </div>
    <div class="container">
        <form  action="{{ route('send_message') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Pesan</label>
                    <textarea name="message" class="form-control pesan" style="height: 300px;"></textarea>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Excel (Nomor)</label>
                    <input type="file" name="file" id="" class="form-control">
                </div>

                <small class="text-danger">Pastikan Whastapp sudah terkoneksi</small><br>
                <button type="submit" class="btn btn-success mt-3 btn-send">Kirim</button>
                <a href="download_template_excel" type="button" class="btn btn-warning mt-3">Download Template Excel</a>
                <button type="button" class="btn btn-default ml-3 mt-3" data-toggle="modal" data-target="#readmeModal">README!!!!</button>
            </div>
            </form>
        </div>
    </div>
    <div class="container d-flex justify-content-center">

    </div>

<!-- Modal -->
<div class="modal fade" id="readmeModal" tabindex="-1" role="dialog" aria-labelledby="readmeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="readmeModalLabel">README</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Jangan spam</p>
            <p>Jangan spam</p>
            <p>Jangan spam</p>
            <p>Pastikan tujuan penggunaan selalu positif</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
{{-- end modal --}}


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>

<script src="{{ asset('js/blast_wa.js') }}"></script>
{{-- <script>
    $(document).ready(function(){
        var socket = io('http://127.0.0.1:8000/test');
        console.log(socket);


    })
</script> --}}

     {{-- <script>
        $(function() {
            let ip_address = '127.0.0.1';
            let socket_port = '8000';
            let socket = io(ip_address + ':' + socket_port +'/test');

            let chatInput = $('#chatInput');

            chatInput.keypress(function(e) {
                let message = $(this).html();
                console.log(message);
                if(e.which === 13 && !e.shiftKey) {
                    socket.emit('sendChatToServer', message);
                    chatInput.html('');
                    return false;
                }
            });

            socket.on('sendChatToClient', (message) => {
                $('.chat-content ul').append(`<li>${message}</li>`);
            });
        });
    </script> --}}

</body>
</html>
