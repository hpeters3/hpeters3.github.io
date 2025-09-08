module.exports = {
  extends: [
    "react-app",
    "react-app/jest"
  ],
  plugins: ["react"],
  env: {
    browser: true,
    es2021: true,
    jest: true
  },
  parserOptions: {
    ecmaVersion: 12,
    sourceType: "module",
    ecmaFeatures: {
      jsx: true
    }
  }
};