import React from 'react'
import ReactDOM from 'react-dom/client'
import { canvas, InstUISettingsProvider } from '@instructure/ui'
import Navbar from './components/Navbar.tsx'
import { BrowserRouter, Route, Routes } from 'react-router-dom'
import Login from './components/Login.tsx'
import Register from './components/Register.tsx'

ReactDOM.createRoot(document.getElementById('root')!).render(
	<React.StrictMode>
		<InstUISettingsProvider theme={canvas}>
			<Navbar />
			<BrowserRouter>
				<Routes>
					{/*<Route path="/" element={} />*/}
					<Route path='/login' element={<Login />} />
					<Route path='/register' element={<Register />} />
				</Routes>
			</BrowserRouter>
		</InstUISettingsProvider>
	</React.StrictMode>,
)
