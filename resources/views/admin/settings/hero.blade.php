@extends('layouts.admin')
@section('title', 'Hero Slider')
@section('page-title', 'Hero Slider')

@section('content')
<div class="w-full" x-data="heroManager()" x-init="init({{ json_encode($slides) }})">
    <form method="POST" action="{{ route('admin.settings.hero.update') }}" enctype="multipart/form-data">
        @csrf

        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
            <p style="font-size:.875rem;color:#7a6a4a;">Add slides with image or video background. Drag to reorder.</p>
            <button type="button" @click="addSlide"
                class="inline-flex items-center gap-2 bg-primary-600 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-primary-700">
                + Add Slide
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
            <template x-for="(slide, index) in slides" :key="index">
                <div style="background:#1a1408;" class=" rounded-xl border border-gray-200 overflow-hidden">
                    {{-- Slide header --}}
                    <div class="flex items-center justify-between px-4 py-3 bg-gray-50 border-b border-gray-200">
                        <span class="text-sm font-semibold text-gray-700" x-text="'Slide ' + (index + 1)"></span>
                        <button type="button" @click="removeSlide(index)" class="text-red-400 hover:text-red-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <div class="p-4 space-y-3">
                        {{-- Type toggle --}}
                        <div class="flex rounded-lg overflow-hidden border border-gray-200 text-sm">
                            <button type="button" @click="slide.type='image'"
                                :class="slide.type==='image' ? 'bg-primary-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-50'"
                                class="flex-1 py-1.5 font-medium transition-colors">🖼 Image</button>
                            <button type="button" @click="slide.type='video'"
                                :class="slide.type==='video' ? 'bg-primary-600 text-white' : 'bg-white text-gray-600 hover:bg-gray-50'"
                                class="flex-1 py-1.5 font-medium transition-colors">🎬 Video</button>
                        </div>

                        {{-- Image upload --}}
                        <div x-show="slide.type==='image'">
                            <template x-if="slide.image">
                                <img :src="'/storage/' + slide.image" class="w-full h-28 object-cover rounded-lg mb-2">
                            </template>
                            <input type="file" :name="'slides[' + index + '][image]'" accept="image/*"
                                class="w-full text-xs border border-gray-300 rounded-lg px-3 py-2">
                            <input type="hidden" :name="'slides[' + index + '][existing_image]'" :value="slide.image">
                        </div>

                        {{-- Video URL --}}
                        <div x-show="slide.type==='video'">
                            <label class="block text-xs font-medium text-gray-500 mb-1">YouTube URL</label>
                            <input type="text" :name="'slides[' + index + '][video_url]'" x-model="slide.video_url"
                                placeholder="https://youtube.com/watch?v=..."
                                style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                        </div>

                        <input type="hidden" :name="'slides[' + index + '][type]'" :value="slide.type">

                        {{-- Title --}}
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Title</label>
                            <input type="text" :name="'slides[' + index + '][title]'" x-model="slide.title"
                                placeholder="Slide heading"
                                style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                        </div>

                        {{-- Subtitle --}}
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Subtitle</label>
                            <input type="text" :name="'slides[' + index + '][subtitle]'" x-model="slide.subtitle"
                                placeholder="Short description"
                                style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                        </div>

                        {{-- Buttons --}}
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">Button 1 Text</label>
                                <input type="text" :name="'slides[' + index + '][btn1_text]'" x-model="slide.btn1_text"
                                    placeholder="Join Now"
                                    style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">Button 1 URL</label>
                                <input type="text" :name="'slides[' + index + '][btn1_url]'" x-model="slide.btn1_url"
                                    placeholder="/register/investor"
                                    style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">Button 2 Text</label>
                                <input type="text" :name="'slides[' + index + '][btn2_text]'" x-model="slide.btn2_text"
                                    placeholder="Learn More"
                                    style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">Button 2 URL</label>
                                <input type="text" :name="'slides[' + index + '][btn2_url]'" x-model="slide.btn2_url"
                                    placeholder="/about"
                                    style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem .75rem;font-size:.875rem;outline:none;box-sizing:border-box;">
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <div style="margin-top:1.5rem;">
            <button type="submit" class="bg-primary-600 text-white font-medium px-8 py-2.5 rounded-lg hover:bg-primary-700 text-sm">
                Save Slider
            </button>
        </div>
    </form>
</div>

<script>
function heroManager() {
    return {
        slides: [],
        init(data) { this.slides = data.length ? data : []; },
        addSlide() {
            this.slides.push({ type: 'image', image: '', video_url: '', title: '', subtitle: '', btn1_text: '', btn1_url: '', btn2_text: '', btn2_url: '' });
        },
        removeSlide(i) { this.slides.splice(i, 1); }
    }
}
</script>
@endsection
