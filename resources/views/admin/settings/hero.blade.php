@extends('layouts.admin')
@section('title', 'Hero Slider')
@section('page-title', 'Hero Slider')

@section('content')
<div x-data="heroManager()" x-init="init({{ json_encode($slides) }})">
    <form method="POST" action="{{ route('admin.settings.hero.update') }}" enctype="multipart/form-data">
        @csrf

        {{-- Toolbar --}}
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:.75rem;">
            <p style="font-size:.875rem;color:#6b7280;margin:0;display:flex;align-items:center;gap:.375rem;">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Add slides with image or video background.
            </p>
            <button type="button" @click="addSlide"
                style="display:inline-flex;align-items:center;gap:.375rem;background:#6366f1;color:#fff;font-size:.875rem;font-weight:600;padding:.5rem 1.125rem;border-radius:.625rem;border:none;cursor:pointer;box-shadow:0 2px 8px rgba(99,102,241,.3);transition:all .15s;"
                onmouseover="this.style.background='#4f46e5';this.style.transform='translateY(-1px)';"
                onmouseout="this.style.background='#6366f1';this.style.transform='translateY(0)';">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Add Slide
            </button>
        </div>

        {{-- Slides Grid --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:1.25rem;">
            <template x-for="(slide, index) in slides" :key="index">
                <div style="background:#fff;border:1px solid #e5e7eb;border-radius:1rem;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.04);transition:box-shadow .2s;"
                     onmouseover="this.style.boxShadow='0 4px 16px rgba(0,0,0,.08)';"
                     onmouseout="this.style.boxShadow='0 1px 4px rgba(0,0,0,.04)';">

                    {{-- Card Header --}}
                    <div style="display:flex;align-items:center;justify-content:space-between;padding:.75rem 1rem;background:linear-gradient(135deg,#6366f1,#8b5cf6);border-bottom:1px solid #e5e7eb;">
                        <div style="display:flex;align-items:center;gap:.5rem;">
                            <div style="width:1.5rem;height:1.5rem;background:rgba(255,255,255,.2);border-radius:.375rem;display:flex;align-items:center;justify-content:center;">
                                <span style="font-size:.7rem;font-weight:800;color:#fff;" x-text="index + 1"></span>
                            </div>
                            <span style="font-size:.875rem;font-weight:700;color:#fff;" x-text="'Slide ' + (index + 1)"></span>
                        </div>
                        <button type="button" @click="removeSlide(index)"
                                style="background:rgba(255,255,255,.15);border:none;cursor:pointer;color:#fff;border-radius:.375rem;padding:.25rem;transition:background .15s;"
                                onmouseover="this.style.background='rgba(239,68,68,.4)';" onmouseout="this.style.background='rgba(255,255,255,.15)';">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <div style="padding:1rem;display:flex;flex-direction:column;gap:.875rem;">

                        {{-- Type Toggle --}}
                        <div style="display:flex;border-radius:.5rem;overflow:hidden;border:1px solid #e5e7eb;background:#f8fafc;">
                            <button type="button" @click="slide.type='image'"
                                :style="slide.type==='image' ? 'background:#6366f1;color:#fff;' : 'background:transparent;color:#6b7280;'"
                                style="flex:1;padding:.4rem;font-size:.8125rem;font-weight:600;border:none;cursor:pointer;transition:all .2s;display:flex;align-items:center;justify-content:center;gap:.25rem;">
                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Image
                            </button>
                            <button type="button" @click="slide.type='video'"
                                :style="slide.type==='video' ? 'background:#6366f1;color:#fff;' : 'background:transparent;color:#6b7280;'"
                                style="flex:1;padding:.4rem;font-size:.8125rem;font-weight:600;border:none;cursor:pointer;transition:all .2s;display:flex;align-items:center;justify-content:center;gap:.25rem;">
                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.069A1 1 0 0121 8.87v6.26a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                Video
                            </button>
                        </div>

                        {{-- Image Upload --}}
                        <div x-show="slide.type==='image'">
                            <template x-if="slide.image">
                                <img :src="'/storage/' + slide.image" style="width:100%;height:7rem;object-fit:cover;border-radius:.625rem;margin-bottom:.5rem;display:block;border:1px solid #e5e7eb;">
                            </template>
                            <input type="file" :name="'slides[' + index + '][image]'" accept="image/*"
                                style="width:100%;background:#f8fafc;border:1px solid #e5e7eb;color:#6b7280;border-radius:.5rem;padding:.4rem .75rem;font-size:.75rem;box-sizing:border-box;cursor:pointer;">
                            <input type="hidden" :name="'slides[' + index + '][existing_image]'" :value="slide.image">
                        </div>

                        {{-- Video URL --}}
                        <div x-show="slide.type==='video'">
                            <label style="display:block;font-size:.75rem;font-weight:600;color:#6b7280;margin-bottom:.375rem;">YouTube URL</label>
                            <input type="text" :name="'slides[' + index + '][video_url]'" x-model="slide.video_url"
                                placeholder="https://youtube.com/watch?v=..."
                                style="width:100%;background:#f8fafc;border:1px solid #e5e7eb;color:#111827;border-radius:.5rem;padding:.5rem .75rem;font-size:.8125rem;outline:none;box-sizing:border-box;transition:border-color .15s;"
                                onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                        </div>

                        <input type="hidden" :name="'slides[' + index + '][type]'" :value="slide.type">

                        {{-- Title --}}
                        <div>
                            <label style="display:block;font-size:.75rem;font-weight:600;color:#374151;margin-bottom:.375rem;">Title</label>
                            <input type="text" :name="'slides[' + index + '][title]'" x-model="slide.title"
                                placeholder="Slide heading"
                                style="width:100%;background:#f8fafc;border:1px solid #e5e7eb;color:#111827;border-radius:.5rem;padding:.5rem .75rem;font-size:.8125rem;outline:none;box-sizing:border-box;transition:border-color .15s;"
                                onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                        </div>

                        {{-- Subtitle --}}
                        <div>
                            <label style="display:block;font-size:.75rem;font-weight:600;color:#374151;margin-bottom:.375rem;">Subtitle</label>
                            <input type="text" :name="'slides[' + index + '][subtitle]'" x-model="slide.subtitle"
                                placeholder="Short description"
                                style="width:100%;background:#f8fafc;border:1px solid #e5e7eb;color:#111827;border-radius:.5rem;padding:.5rem .75rem;font-size:.8125rem;outline:none;box-sizing:border-box;transition:border-color .15s;"
                                onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                        </div>

                        {{-- Buttons --}}
                        <div style="background:#f8fafc;border-radius:.625rem;padding:.75rem;border:1px solid #f3f4f6;">
                            <p style="font-size:.7rem;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.08em;margin:0 0 .625rem;">Call to Action Buttons</p>
                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:.5rem;">
                                <div>
                                    <label style="display:block;font-size:.7rem;font-weight:600;color:#6b7280;margin-bottom:.25rem;">Button 1 Text</label>
                                    <input type="text" :name="'slides[' + index + '][btn1_text]'" x-model="slide.btn1_text" placeholder="Join Now"
                                        style="width:100%;background:#fff;border:1px solid #e5e7eb;color:#111827;border-radius:.375rem;padding:.4rem .625rem;font-size:.75rem;outline:none;box-sizing:border-box;transition:border-color .15s;"
                                        onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                                </div>
                                <div>
                                    <label style="display:block;font-size:.7rem;font-weight:600;color:#6b7280;margin-bottom:.25rem;">Button 1 URL</label>
                                    <input type="text" :name="'slides[' + index + '][btn1_url]'" x-model="slide.btn1_url" placeholder="/register"
                                        style="width:100%;background:#fff;border:1px solid #e5e7eb;color:#6b7280;border-radius:.375rem;padding:.4rem .625rem;font-size:.75rem;outline:none;box-sizing:border-box;transition:border-color .15s;"
                                        onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                                </div>
                                <div>
                                    <label style="display:block;font-size:.7rem;font-weight:600;color:#6b7280;margin-bottom:.25rem;">Button 2 Text</label>
                                    <input type="text" :name="'slides[' + index + '][btn2_text]'" x-model="slide.btn2_text" placeholder="Learn More"
                                        style="width:100%;background:#fff;border:1px solid #e5e7eb;color:#111827;border-radius:.375rem;padding:.4rem .625rem;font-size:.75rem;outline:none;box-sizing:border-box;transition:border-color .15s;"
                                        onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                                </div>
                                <div>
                                    <label style="display:block;font-size:.7rem;font-weight:600;color:#6b7280;margin-bottom:.25rem;">Button 2 URL</label>
                                    <input type="text" :name="'slides[' + index + '][btn2_url]'" x-model="slide.btn2_url" placeholder="/about"
                                        style="width:100%;background:#fff;border:1px solid #e5e7eb;color:#6b7280;border-radius:.375rem;padding:.4rem .625rem;font-size:.75rem;outline:none;box-sizing:border-box;transition:border-color .15s;"
                                        onfocus="this.style.borderColor='#6366f1';" onblur="this.style.borderColor='#e5e7eb';">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </template>

            {{-- Empty state --}}
            <template x-if="slides.length === 0">
                <div style="grid-column:1/-1;text-align:center;padding:3rem;background:#fff;border:2px dashed #e5e7eb;border-radius:1rem;">
                    <div style="width:3rem;height:3rem;background:#eef2ff;border-radius:1rem;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                        <svg width="20" height="20" fill="none" stroke="#6366f1" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <p style="color:#6b7280;font-size:.9375rem;margin:0 0 1rem;font-weight:500;">No slides yet. Add your first slide.</p>
                    <button type="button" @click="addSlide"
                            style="background:#6366f1;color:#fff;font-weight:600;padding:.5rem 1.25rem;border-radius:.625rem;border:none;cursor:pointer;font-size:.875rem;">
                        + Add Slide
                    </button>
                </div>
            </template>
        </div>

        <div style="margin-top:1.5rem;">
            <button type="submit"
                    style="background:#6366f1;color:#fff;font-weight:600;padding:.625rem 2rem;border-radius:.625rem;border:none;cursor:pointer;font-size:.9375rem;box-shadow:0 2px 8px rgba(99,102,241,.3);transition:all .15s;"
                    onmouseover="this.style.background='#4f46e5';this.style.transform='translateY(-1px)';"
                    onmouseout="this.style.background='#6366f1';this.style.transform='translateY(0)';">
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
