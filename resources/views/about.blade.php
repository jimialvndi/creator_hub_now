@extends('layouts.app')

@section('title', 'About - UNTAN Creator Hub')

@section('content')
<!-- Page Header -->
<section class="bg-primary text-white py-20">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-4">About UNTAN Creator Hub</h1>
        <p class="text-xl text-gray-300">Empowering the next generation of content creators</p>
    </div>
</section>

<!-- About Content -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto space-y-12">
            <!-- What is UNTAN Creator Hub -->
            <div>
                <h2 class="text-3xl font-bold text-primary mb-6 flex items-center gap-2">
                    <span class="text-accent">★</span> What is UNTAN Creator Hub?
                </h2>
                <p class="text-gray-700 text-lg leading-relaxed mb-4">
                    UNTAN Creator Hub is a dedicated platform designed to showcase, manage, and promote talented student content creators from Universitas Tanjungpura. We serve as a bridge between creative students and opportunities that can help them grow professionally.
                </p>
                <p class="text-gray-700 text-lg leading-relaxed">
                    Our platform curates the best student creators across various niches - from education and lifestyle to videography and digital marketing - making it easy for brands, organizations, and collaborators to discover and connect with the right talent.
                </p>
            </div>

            <!-- Vision & Mission -->
            <div class="bg-gray-50 p-8 rounded-xl">
                <h2 class="text-3xl font-bold text-primary mb-6 flex items-center gap-2">
                    <span class="text-accent">★</span> Vision & Mission
                </h2>
                <div class="space-y-6">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Our Vision</h3>
                        <p class="text-gray-700 leading-relaxed">
                            To become the leading platform for student content creators in Indonesia, fostering a community where creativity meets opportunity and talent gets recognized.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Our Mission</h3>
                        <ul class="list-disc list-inside text-gray-700 space-y-2">
                            <li>Provide a professional platform for student creators to showcase their work</li>
                            <li>Connect talented students with meaningful collaboration opportunities</li>
                            <li>Support creator development through training and mentorship programs</li>
                            <li>Build a strong community of creative and innovative students</li>
                            <li>Promote student achievements and talent beyond campus boundaries</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Role in Development -->
            <div>
                <h2 class="text-3xl font-bold text-primary mb-6 flex items-center gap-2">
                    <span class="text-accent">★</span> Our Role in Developing Student Creators
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-primary text-white p-6 rounded-xl">
                        <h3 class="text-xl font-bold mb-3">Talent Management</h3>
                        <p class="text-gray-200">
                            We carefully curate and manage our creator portfolio, ensuring quality and professionalism in every collaboration.
                        </p>
                    </div>
                    <div class="bg-primary text-white p-6 rounded-xl">
                        <h3 class="text-xl font-bold mb-3">Opportunity Creation</h3>
                        <p class="text-gray-200">
                            We actively connect our creators with brands, events, and projects that match their skills and interests.
                        </p>
                    </div>
                    <div class="bg-primary text-white p-6 rounded-xl">
                        <h3 class="text-xl font-bold mb-3">Skills Development</h3>
                        <p class="text-gray-200">
                            We provide resources, workshops, and mentorship to help our creators continuously improve their craft.
                        </p>
                    </div>
                    <div class="bg-primary text-white p-6 rounded-xl">
                        <h3 class="text-xl font-bold mb-3">Community Building</h3>
                        <p class="text-gray-200">
                            We foster a supportive community where creators can network, collaborate, and learn from each other.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Why Choose UNTAN Creators -->
            <div class="bg-accent bg-opacity-10 p-8 rounded-xl border-2 border-accent">
                <h2 class="text-3xl font-bold text-primary mb-6">Why Choose UNTAN Creators?</h2>
                <ul class="space-y-4 text-gray-700 text-lg">
                    <li class="flex items-start gap-3">
                        <span class="text-accent text-2xl">★</span>
                        <span><strong>Vetted Talent:</strong> All our creators are carefully selected and managed for professionalism and quality.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-accent text-2xl">★</span>
                        <span><strong>Diverse Expertise:</strong> From videography to education content, find creators across multiple niches.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-accent text-2xl">★</span>
                        <span><strong>Student Perspective:</strong> Get authentic, relatable content that resonates with young audiences.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-accent text-2xl">★</span>
                        <span><strong>Managed Process:</strong> Work through our hub for smooth collaboration and professional support.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-primary text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Ready to Work With Our Creators?</h2>
        <p class="text-xl text-gray-300 mb-8">Let's collaborate and create something amazing together</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('talents.index') }}" class="inline-block bg-accent text-primary px-8 py-3 rounded-full font-bold hover:bg-yellow-300 transition">
                Browse Talents
            </a>
            <a href="{{ route('contact.index') }}" class="inline-block border-2 border-white text-white px-8 py-3 rounded-full font-bold hover:bg-white hover:text-primary transition">
                Contact Us
            </a>
        </div>
    </div>
</section>
@endsection
