<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/image/logometland.png" type="image/png">
    <title>{{ $news->title }} - Metland School</title>


    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Translation System -->
    @include('partials.translations')

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        [x-cloak] {
            display: none !important;
        }

        .breadcrumb-arrow::after {
            content: '›';
            margin: 0 8px;
        }

        .prose h1,
        .prose h2,
        .prose h3,
        .prose h4 {
            font-weight: 700;
            margin-top: 1.5em;
            margin-bottom: 0.5em;
            color: #1f2937;
        }

        .prose h1 {
            font-size: 2em;
        }

        .prose h2 {
            font-size: 1.5em;
        }

        .prose h3 {
            font-size: 1.25em;
        }

        .prose p {
            margin-bottom: 1em;
            line-height: 1.8;
            color: #4b5563;
        }

        .prose ul,
        .prose ol {
            margin-left: 1.5em;
            margin-bottom: 1em;
        }

        .prose li {
            margin-bottom: 0.5em;
        }

        .prose img {
            border-radius: 8px;
            margin: 1.5em 0;
            max-width: 100%;
        }

        .prose a {
            color: #1e40af;
            text-decoration: underline;
        }

        .prose blockquote {
            border-left: 4px solid #1e40af;
            padding-left: 1em;
            margin: 1.5em 0;
            font-style: italic;
            color: #6b7280;
        }

        .prose {
            word-wrap: break-word;
            overflow-wrap: break-word;
            word-break: break-word;
        }
    </style>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e40af',
                        'primary-dark': '#1e3a8a',
                        'primary-light': '#3b82f6',
                        'secondary': '#f59e0b',
                    }
                }
            }
        }
    </script>
</head>

<body x-data="{
    lang: 'id',
    t: {
        id: {
            home: 'Beranda',
            news: 'Berita Sekolah',
            readMore: 'Baca Selengkapnya',
            relatedNews: 'Berita Terkait',
            share: 'Bagikan',
            backToNews: 'Kembali ke Berita',
            views: 'dilihat',
            author: 'Penulis'
        },
        en: {
            home: 'Home',
            news: 'School News',
            readMore: 'Read More',
            relatedNews: 'Related News',
            share: 'Share',
            backToNews: 'Back to News',
            views: 'views',
            author: 'Author'
        }
    },
    showShareModal: false,
    toggleLang() { this.lang = this.lang === 'id' ? 'en' : 'id'; },
    copyLink() {
        navigator.clipboard.writeText(window.location.href);
        alert(this.lang === 'id' ? 'Link berhasil disalin!' : 'Link copied!');
        this.showShareModal = false;
    }
}" class="bg-gray-50 overflow-x-hidden">

    <!-- Navbar -->
    <x-navbar :solid-background="true" :show-on-scroll="false" />

    <!-- Hero Section -->
    <section class="relative min-h-[35vh] md:min-h-[45vh] bg-[#1a1a1a] flex items-end pt-20">
        <div class="absolute inset-0">
            @if($news->image)
            <img src="{{ img_url($news->image, 'news', $news->id, 'image') }}" alt="{{ $news->title }}" class="w-full h-full object-cover opacity-40">
            @else
            <img src="{{ asset('image/sekolahsmkmetland.png') }}" alt="{{ $news->title }}" class="w-full h-full object-cover opacity-40">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-[#1a1a1a] via-[#1a1a1a]/70 to-transparent"></div>
        </div>

        <div class="relative z-10 w-full max-w-7xl mx-auto px-6 md:px-12 lg:px-20 pb-8 md:pb-12">
            <!-- Breadcrumb -->
            <div class="flex items-center text-white/70 mb-4 text-xs md:text-sm flex-wrap">
                <a href="/" class="hover:text-white transition" x-text="t[lang].home"></a>
                <span class="breadcrumb-arrow"></span>
                <a href="/news" class="hover:text-white transition" x-text="t[lang].news"></a>
                <span class="breadcrumb-arrow"></span>
                <span class="text-white font-medium">{{ Str::limit($news->title, 40) }}</span>
            </div>

            <!-- Category Badge -->
            @php
            $categoryColors = [
            'academic' => 'bg-green-500',
            'achievement' => 'bg-yellow-500',
            'activity' => 'bg-purple-500',
            'workshop' => 'bg-orange-500',
            'extracurricular' => 'bg-blue-500',
            'scout' => 'bg-red-500',
            'arts' => 'bg-pink-500',
            'alumni' => 'bg-indigo-500',
            ];
            $colorClass = $categoryColors[$news->category] ?? 'bg-gray-500';
            @endphp
            <span class="inline-block px-3 py-1 {{ $colorClass }} text-white text-xs font-bold uppercase tracking-wide mb-4 rounded">
                {{ ucfirst($news->category) }}
            </span>

            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 leading-tight max-w-4xl">
                {{ $news->title }}
            </h1>

            <div class="flex flex-wrap items-center gap-4 text-white/60 text-sm">
                <span><i class="far fa-calendar-alt mr-2"></i>{{ $news->formatted_date }}</span>
                <span><i class="far fa-eye mr-2"></i>{{ $news->views }} <span x-text="t[lang].views"></span></span>
                @if($news->author)
                <span><i class="far fa-user mr-2"></i>{{ $news->author }}</span>
                @endif
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 py-8 md:py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Article Content -->
            <div class="lg:col-span-2">
                <article class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <!-- Featured Image -->
                    @if($news->image)
                    <div class="w-full">
                        <img src="{{ img_url($news->image, 'news', $news->id, 'image') }}" alt="{{ $news->title }}" class="w-full h-auto max-h-[500px] object-cover">
                    </div>
                    @endif

                    <!-- Content -->
                    <div class="p-6 md:p-8">
                        @if($news->excerpt)
                        <p class="text-lg text-gray-600 font-medium mb-6 pb-6 border-b border-gray-100">
                            {{ $news->excerpt }}
                        </p>
                        @endif

                        <div class="prose max-w-none">
                            {!! $news->content !!}
                        </div>

                        <!-- Share Section -->
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <div class="flex items-center justify-between flex-wrap gap-4">
                                <span class="text-gray-600 font-medium"><span x-text="$store.lang.t('news_share_title')">Bagikan</span>:</span>
                                <div class="flex gap-2">
                                    <button @click="copyLink()" class="w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center transition" title="Copy Link">
                                        <i class="fas fa-link text-gray-600"></i>
                                    </button>
                                    <a href="https://wa.me/?text={{ urlencode($news->title . ' - ' . url()->current()) }}" target="_blank" class="w-10 h-10 bg-green-500 hover:bg-green-600 rounded-full flex items-center justify-center transition" title="WhatsApp">
                                        <i class="fab fa-whatsapp text-white"></i>
                                    </a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="w-10 h-10 bg-blue-600 hover:bg-blue-700 rounded-full flex items-center justify-center transition" title="Facebook">
                                        <i class="fab fa-facebook-f text-white"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($news->title) }}&url={{ urlencode(url()->current()) }}" target="_blank" class="w-10 h-10 bg-sky-500 hover:bg-sky-600 rounded-full flex items-center justify-center transition" title="Twitter">
                                        <i class="fab fa-twitter text-white"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                <div class="mt-6">
                    <a href="/news" class="inline-flex items-center gap-2 text-primary hover:text-primary-dark transition font-medium">
                        <i class="fas fa-arrow-left"></i>
                        <span x-text="$store.lang.t('news_back')">Kembali ke Berita</span>
                    </a>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                @if($relatedNews->count() > 0)
                <div class="bg-white rounded-xl shadow-sm p-6 sticky top-24">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 pb-3 border-b border-gray-100" x-text="$store.lang.t('news_related')">Berita Terkait</h3>
                    <div class="space-y-4">
                        @foreach($relatedNews as $related)
                        <a href="{{ route('news.show', $related->slug) }}" class="block group">
                            <div class="flex gap-4">
                                <div class="w-20 h-20 flex-shrink-0 overflow-hidden rounded-lg bg-gray-100">
                                    @if($related->image)
                                    <img src="{{ img_url($related->image, 'news', $related->id, 'image') }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    @else
                                    <img src="{{ asset('image/sekolahsmkmetland.png') }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-gray-900 group-hover:text-primary transition line-clamp-2 text-sm mb-1">
                                        {{ $related->title }}
                                    </h4>
                                    <span class="text-xs text-gray-500">
                                        <i class="far fa-calendar-alt mr-1"></i>{{ $related->formatted_date }}
                                    </span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-100">
                        <a href="/news" class="text-primary hover:text-primary-dark font-medium text-sm flex items-center gap-2">
                            <span x-text="t[lang].news"></span>
                            <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>


    @include('components.footer')
</body>

</html>