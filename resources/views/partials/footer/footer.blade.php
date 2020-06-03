<footer id="footerGeneric" class="container">
    <hr>
    <article class="row">
        <section class="col">
            <h5 class="title"> More</h5>
            <ul class="list-unstyled">
                <li><a href={{route('faq')}}> Help</a></li>
                <li><a href={{route('contact')}}> Contact</a></li>
                <li><a href={{route('about')}}> About us</a></li>
            </ul>
        </section>
        <section class="col">
            <h5 class="title"> Shortcuts </h5>
            <ul class="list-unstyled">
                @if(Auth::check()) <li><a href={{ route('profile', ['username' => Auth::user()->username]) }}>
                        Profile</a></li>@endif
                <li><a href={{route('home')}}> Homepage</a></li>
                <li><a href={{route('search')}}> All products</a></li>
            </ul>
        </section>
        <section class="col ml-auto my-auto">
            <p>© Copyright 2020 Key Share. All rights reserved.</p>
        </section>
    </article>
</footer>