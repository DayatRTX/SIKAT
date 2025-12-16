import './bootstrap';
import * as Turbo from '@hotwired/turbo';

// Enable Turbo Drive for seamless page navigation (keeps BGM playing)
Turbo.start();

// Global Audio Manager for BGM across pages
window.SikatBGM = window.SikatBGM || {
    audio: null,
    isInitialized: false,
    
    init() {
        if (this.isInitialized && this.audio) return;
        
        // Create persistent audio element
        this.audio = new Audio('/audio/bgm.mp3');
        this.audio.loop = true;
        this.audio.volume = parseFloat(localStorage.getItem('sikat_bgm_volume')) || 0.3;
        this.audio.preload = 'auto';
        
        // Restore time position
        const savedTime = parseFloat(localStorage.getItem('sikat_bgm_time')) || 0;
        this.audio.currentTime = savedTime;
        
        // Save position every 100ms
        setInterval(() => {
            if (this.audio && !this.audio.paused) {
                localStorage.setItem('sikat_bgm_time', this.audio.currentTime.toString());
            }
        }, 100);
        
        this.isInitialized = true;
        
        // Auto-resume if was playing
        const wasPlaying = localStorage.getItem('sikat_bgm_state') === 'playing';
        if (wasPlaying) {
            this.play();
        }
    },
    
    play() {
        if (!this.audio) this.init();
        const playPromise = this.audio.play();
        if (playPromise !== undefined) {
            playPromise.then(() => {
                localStorage.setItem('sikat_bgm_state', 'playing');
                this.updateUI(true);
            }).catch(() => {
                this.updateUI(false);
            });
        }
    },
    
    pause() {
        if (this.audio) {
            this.audio.pause();
            localStorage.setItem('sikat_bgm_state', 'paused');
            this.updateUI(false);
        }
    },
    
    toggle() {
        if (!this.audio) this.init();
        if (this.audio.paused) {
            this.play();
        } else {
            this.pause();
        }
    },
    
    updateUI(isPlaying) {
        const icon = document.getElementById('bgm-icon');
        const indicator = document.getElementById('bgm-playing-indicator');
        const btn = document.getElementById('bgm-toggle');
        
        if (icon && indicator && btn) {
            if (isPlaying) {
                icon.className = 'fas fa-music text-white text-xl animate-pulse';
                indicator.style.opacity = '1';
            } else {
                icon.className = 'fas fa-music-slash text-white text-xl';
                indicator.style.opacity = '0';
            }
        }
    },
    
    isPlaying() {
        return this.audio && !this.audio.paused;
    }
};

// Initialize on DOM ready and after Turbo navigations
function initBGMPlayer() {
    window.SikatBGM.init();
    
    // Update UI based on current state
    window.SikatBGM.updateUI(window.SikatBGM.isPlaying());
    
    // Bind click handler to toggle button
    const toggleBtn = document.getElementById('bgm-toggle');
    if (toggleBtn && !toggleBtn.hasAttribute('data-bgm-bound')) {
        toggleBtn.setAttribute('data-bgm-bound', 'true');
        toggleBtn.addEventListener('click', () => {
            window.SikatBGM.toggle();
        });
    }
}

// Initialize on first load
document.addEventListener('DOMContentLoaded', initBGMPlayer);

// Re-initialize UI after Turbo navigation (audio keeps playing)
document.addEventListener('turbo:load', initBGMPlayer);
document.addEventListener('turbo:render', initBGMPlayer);
