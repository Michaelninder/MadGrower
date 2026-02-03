@extends('layouts.main')

@section('main-content')

    <section class="content-section hero-section">
        <h1 class="text-primary">Lander Ipsum</h1>
        <p class="lead-text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Nisi repudiandae fugit et similique illum vitae facere quisquam possimus ipsa.
        </p>
        <div class="cta-group">
            <a href="#" class="button-primary">Get Started</a>
            <a href="#" class="button-tertiary">Learn More</a>
        </div>
    </section>

    <section class="content-section">
        <h2 class="text-secondary">Core Features</h2>
        <div class="content-grid">

            <div class="card">
                <h3>Feature Alpha</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                   Fugiat obcaecati excepturi natus officia fugit ipsam facere eius ab odit optio porro.</p>
            </div>

            <div class="card">
                <h3>Feature Beta</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                   Ut id perspiciatis explicabo, iste autem reiciendis numquam, nisi architecto.</p>
            </div>

            <div class="card">
                <h3>Feature Gamma</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                   Quo hic culpa ab quos, ad repudiandae quam beatae voluptate porro eius quas.</p>
            </div>

        </div>
    </section>

    <section class="content-section bg-alt">
        <div class="split-view">

            <div class="text-block">
                <h2 class="text-tertiary">In-Depth Analysis</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                   Nisi adipisci, facilis cum ea minima nobis distinctio nam asperiores?
                   Iusto eveniet odit repellat eaque incidunt iste molestiae suscipit atque non esse.</p>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                   Expedita, nemo corrupti. Officia, non mollitia?
                   Accusantium quisquam sequi error quasi vero voluptatibus quaerat.</p>
            </div>

            <div class="image-placeholder rounded-lg"></div>

        </div>
    </section>

    <section class="content-section">
        <div class="stats-grid">

            <div class="stat-item">
                <span class="stat-number text-primary">99%</span>
                <span class="stat-label">Lorem Ipsum</span>
            </div>

            <div class="stat-item">
                <span class="stat-number text-primary">24/7</span>
                <span class="stat-label">Dolor Sit Amet</span>
            </div>

            <div class="stat-item">
                <span class="stat-number text-primary">500+</span>
                <span class="stat-label">Consectetur</span>
            </div>

        </div>
    </section>

    <section class="content-section quote-section">
        <blockquote>
            <p>"Lorem ipsum, dolor sit amet consectetur adipisicing elit.
               Animi accusamus molestiae, asperiores beatae sint hic voluptatibus
               fugiat vero nam voluptatum, quisquam culpa vitae nobis rem aliquid dolorem!"</p>
            <cite>— Lorem Ipsum, CEO of Dolor</cite>
        </blockquote>
    </section>

    <section class="content-section">
        <h2 class="text-secondary">Our Community</h2>
        <div class="users-grid-container">
            @for ($i = 0; $i < 6; $i++)
                <div class="user-item">
                    <div class="user-avatar" style="background: var(--palette-primary)"></div>
                    <span class="user-username">User_{{ $i }}</span>
                    <span class="user-rank">Elite Member</span>
                </div>
            @endfor
        </div>
    </section>

    <section class="content-section final-cta">
        <h2 class="text-primary">Ready to Begin?</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
           Fugit labore ipsa recusandae nisi dolor, quidem corporis distinctio repellendus sint praesentium.</p>
        <button class="button-secondary rounded-full">Join Now</button>
    </section>

@endsection