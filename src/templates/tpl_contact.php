<?php function drawContact(){ ?>
    <div id="content" class="container">
        <div class="row text-center pt-5">
            <div class="col-8 ml-auto mr-auto">
                <h1> Contact us</h1>
                <form>
                    <div class="row my-3 mx-2">
                        <input type="email" class="form-control" placeholder="name">
                    </div>
                    <div class="row my-3 mx-2">
                        <input type="email" class="form-control" placeholder="your@email.com">
                    </div>
                    <div class="row my-3 mx-2">
                        <textarea class="form-control" rows="5" placeholder="message"></textarea>
                    </div>
                    <button class="btn btn-outline-dark ml-auto mr-2 pl-3 pr-3"> Send </button>
                </form>
            </div>
        </div>
    </div>
<?php } ?>