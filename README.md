# 📹 Video Consultancy App

A full-stack web application designed to facilitate seamless video consultations between professionals (e.g., doctors, consultants, tutors) and users. This platform features real-time video calling, appointment scheduling, and secure user management.

## 📋 Table of Contents
- [About](#-about)
- [Key Features](#-key-features)
- [Tech Stack](#-tech-stack)
- [Architecture](#-architecture)
- [Getting Started](#-getting-started)
- [Environment Variables](#-environment-variables)
- [Screenshots](#-screenshots)
- [Contributing](#-contributing)
- [Contact](#-contact)

## 🧐 About
**Video Consultancy** removes the physical barrier between consultants and clients. Whether for telemedicine, legal advice, or tutoring, this application provides a robust environment for booking slots and conducting secure, high-quality video calls directly in the browser.

## ✨ Key Features
* **User Roles:** Separate dashboards for Consultants and Users.
* **Real-time Video Calling:** High-quality video and audio communication using WebRTC and Socket.io.
* **Appointment Scheduling:** Users can view available slots and book appointments.
* **Instant Chat:** Real-time text chat functionality during video calls.
* **Notifications:** Email or in-app notifications for appointment confirmations.
* **Responsive Design:** Fully optimized for desktop, tablet, and mobile devices.

## 🛠 Tech Stack

### Frontend
* **React.js:** Dynamic user interface.
* **Redux / Context API:** State management.
* **Material UI / Tailwind CSS:** Styling and UI components.
* **PeerJS / Simple-peer:** WebRTC wrapper for peer-to-peer video.

### Backend
* **Node.js:** Runtime environment.
* **Express.js:** RESTful API framework.
* **Socket.io:** Real-time bidirectional communication.

### Database & Auth
* **MongoDB:** NoSQL database for storing users and appointments.
* **JWT (JSON Web Tokens):** Secure authentication.

## 🚀 Getting Started

Follow these instructions to set up the project locally on your machine.

### Prerequisites
* [Node.js](https://nodejs.org/) (v14 or higher)
* [MongoDB](https://www.mongodb.com/) (Local or Atlas URL)
* [Git](https://git-scm.com/)

### Installation

**1. Clone the repository**
```bash
git clone [https://github.com/Yashi5769/video-consultancy.git](https://github.com/Yashi5769/video-consultancy.git)
cd video-consultancy
```

**2. Install Server Dependencies** Navigate to the root (or server) directory and install dependencies.
   ```bash
   cd server
   npm install
   ```
## 🔐 Environment Variables

You need to set up environment variables for the application to run correctly.

**1. Server-side (`/server/.env`):** Create a `.env` file in the `server` folder and add the following:

```env
PORT=5000
MONGO_URI=your_mongodb_connection_string
JWT_SECRET=your_jwt_secret_key
CLIENT_URL=http://localhost:3000
