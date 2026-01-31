import { defineConfig } from 'vite';
import typo3 from 'vite-plugin-typo3';

export default defineConfig({
  plugins: [typo3()],
  build: {
    manifest: true,
    rollupOptions: {
      input: {
        styles: 'packages/sitepackage/Resources/Private/Assets/Styles/app.entry.css',
        main: 'packages/sitepackage/Resources/Private/Assets/Scripts/app.entry.ts'
      }
    }
  },
  resolve: {
    alias: {
      '@': '/packages/sitepackage/Resources/Private/Assets'
    }
  }
});
