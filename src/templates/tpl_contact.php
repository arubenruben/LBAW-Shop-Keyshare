<?php function drawContact(){ ?>
    <div class="container mt-5">
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
                    <button type="button" class="btn"> Send </button>
                </form>
            </div>
        </div>
    </div>
<?php } ?>