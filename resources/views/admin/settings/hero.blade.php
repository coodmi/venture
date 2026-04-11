@extends('layouts.admin')
@section('title', 'Hero Slider')
@section('page-title', 'Hero Slider')

@section('content')
<div x-data="heroManager()" x-init="init({{ json_encode($slides) }})">
    <form method="POST" action="{{ route('admin.settings.hero.update') }}" enctype="multipart/form-data">
        @csrf

        {{-- Toolbar --}}
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:.75rem;">
            <p style="font-size:.875rem;color:#7a6a4a;margin:0;">Add slides with image or video background.</p>
            <button type="button" @click="addSlide"
                style="display:inline-flex;align-items:center;gap:.375rem;background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-size:.875rem;font-weight:700;padding:.5rem 1.125rem;border-radius:.625rem;border:none;cursor:pointer;">
                + Add Slide
            </button>
        </div>

        {{-- Slides Grid --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:1.25rem;">
            <template x-for="(slide, index) in slides" :key="index">
                <div style="background:#1a1408;border:1px solid rgba(212,146,15,.15);border-radius:1rem;overflow:hidden;">

                    {{-- Card Header --}}
                    <div style="display:flex;align-items:center;justify-content:space-between;padding:.75rem 1rem;background:#110e05;border-bottom:1px solid rgba(212,146,15,.1);">
                        <span style="font-size:.875rem;font-weight:700;color:#f0e6c8;" x-text="'Slide ' + (index + 1)"></span>
                        <button type="button" @click="removeSlide(index)" style="background:none;border:none;cursor:pointer;color:rgba(239,68,68,.5);" onmouseover="this.style.color='#f87171';" onmouseout="this.style.color='rgba(239,68,68,.5)';">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <div style="padding:1rem;display:flex;flex-direction:column;gap:.875rem;">

                        {{-- Type Toggle --}}
                        <div style="display:flex;border-radius:.5rem;overflow:hidden;border:1px solid rgba(212,146,15,.2);">
                            <button type="button" @click="slide.type='image'"
                                :style="slide.type==='image' ? 'background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;' : 'background:#0d0a04;color:#7a6a4a;'"
                                style="flex:1;padding:.4rem;font-size:.8125rem;font-weight:600;border:none;cursor:pointer;transition:all .2s;">
                                🖼 Image
                            </button>
                            <button type="button" @click="slide.type='video'"
                                :style="slide.type==='video' ? 'background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;' : 'background:#0d0a04;color:#7a6a4a;'"
                                style="flex:1;padding:.4rem;font-size:.8125rem;font-weight:600;border:none;cursor:pointer;transition:all .2s;">
                                🎬 Video
                            </button>
                        </div>

                        {{-- Image Upload --}}
                        <div x-show="slide.type==='image'">
                            <template x-if="slide.image">
                                <img :src="'/storage/' + slide.image" style="width:100%;height:7rem;object-fit:cover;border-radius:.5rem;margin-bottom:.5rem;display:block;">
                            </template>
                            <input type="file" :name="'slides[' + index + '][image]'" accept="image/*"
                                style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.15);color:#9a8a6a;border-radius:.5rem;padding:.4rem .75rem;font-size:.75rem;box-sizing:border-box;">
                            <input type="hidden" :name="'slides[' + index + '][existing_image]'" :value="slide.image">
                        </div>

                        {{-- Video URL --}}
                        <div x-show="slide.type==='video'">
                            <label style="display:block;font-size:.75rem;font-weight:600;color:rgba(212,146,15,.6);margin-bottom:.375rem;">YouTube URL</label>
                            <input type="text" :name="'slides[' + index + '][video_url]'" x-model="slide.video_url"
                                placeholder="https://youtube.com/watch?v=..."
                                style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem .75rem;font-size:.8125rem;outline:none;box-sizing:border-box;">
                        </div>

                        <input type="hidden" :name="'slides[' + index + '][type]'" :value="slide.type">

                        {{-- Title --}}
                        <div>
                            <label style="display:block;font-size:.75rem;font-weight:600;color:rgba(212,146,15,.6);margin-bottom:.375rem;">Title</label>
                            <input type="text" :name="'slides[' + index + '][title]'" x-model="slide.title"
                                placeholder="Slide heading"
                                style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem .75rem;font-size:.8125rem;outline:none;box-sizing:border-box;">
                        </div>

                        {{-- Subtitle --}}
                        <div>
                            <label style="display:block;font-size:.75rem;font-weight:600;color:rgba(212,146,15,.6);margin-bottom:.375rem;">Subtitle</label>
                            <input type="text" :name="'slides[' + index + '][subtitle]'" x-model="slide.subtitle"
                                placeholder="Short description"
                                style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.2);color:#f0e6c8;border-radius:.5rem;padding:.5rem .75rem;font-size:.8125rem;outline:none;box-sizing:border-box;">
                        </div>

                        {{-- Buttons --}}
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:.5rem;">
                            <div>
                                <label style="display:block;font-size:.7rem;font-weight:600;color:rgba(212,146,15,.5);margin-bottom:.25rem;">Button 1 Text</label>
                                <input type="text" :name="'slides[' + index + '][btn1_text]'" x-model="slide.btn1_text" placeholder="Join Now"
                                    style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.15);color:#f0e6c8;border-radius:.375rem;padding:.4rem .625rem;font-size:.75rem;outline:none;box-sizing:border-box;">
                            </div>
                            <div>
                                <label style="display:block;font-size:.7rem;font-weight:600;color:rgba(212,146,15,.5);margin-bottom:.25rem;">Button 1 URL</label>
                                <input type="text" :name="'slides[' + index + '][btn1_url]'" x-model="slide.btn1_url" placeholder="/register/investor"
                                    style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.15);color:#9a8a6a;border-radius:.375rem;padding:.4rem .625rem;font-size:.75rem;outline:none;box-sizing:border-box;">
                            </div>
                            <div>
                                <label style="display:block;font-size:.7rem;font-weight:600;color:rgba(212,146,15,.5);margin-bottom:.25rem;">Button 2 Text</label>
                                <input type="text" :name="'slides[' + index + '][btn2_text]'" x-model="slide.btn2_text" placeholder="Learn More"
                                    style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.15);color:#f0e6c8;border-radius:.375rem;padding:.4rem .625rem;font-size:.75rem;outline:none;box-sizing:border-box;">
                            </div>
                            <div>
                                <label style="display:block;font-size:.7rem;font-weight:600;color:rgba(212,146,15,.5);margin-bottom:.25rem;">Button 2 URL</label>
                                <input type="text" :name="'slides[' + index + '][btn2_url]'" x-model="slide.btn2_url" placeholder="/about"
                                    style="width:100%;background:#0d0a04;border:1px solid rgba(212,146,15,.15);color:#9a8a6a;border-radius:.375rem;padding:.4rem .625rem;font-size:.75rem;outline:none;box-sizing:border-box;">
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            {{-- Empty state --}}
            <template x-if="slides.length === 0">
                <div style="grid-column:1/-1;text-align:center;padding:3rem;background:#1a1408;border:2px dashed rgba(212,146,15,.2);border-radius:1rem;">
                    <p style="color:#6b5c3e;font-size:.9375rem;margin:0 0 1rem;">No slides yet. Add your first slide.</p>
                    <button type="button" @click="addSlide" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.5rem 1.25rem;border-radius:.625rem;border:none;cursor:pointer;font-size:.875rem;">+ Add Slide</button>
                </div>
            </template>
        </div>

        <div style="margin-top:1.5rem;">
            <button type="submit" style="background:linear-gradient(135deg,#d4920f,#f59e0b);color:#0d0a04;font-weight:700;padding:.625rem 2rem;border-radius:.625rem;border:none;cursor:pointer;font-size:.9375rem;">
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
            this.slides.push({ type:'image', image:'', video_url:'', title:'', subtitle:'', btn1_text:'', btn1_url:'', btn2_text:'', btn2_url:'' });
        },
        removeSlide(i) { this.slides.splice(i, 1); }
    }
}
</script>
@endsection
