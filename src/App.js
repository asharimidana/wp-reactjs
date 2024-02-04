import React from "react";
import Dashboard from "./components/Dashboard";
import { useLocation, BrowserRouter, Routes, Route } from "react-router-dom";
const App = () => {
	const urlParams = new URLSearchParams(window.location.search);
	console.log(urlParams.get("page"));
	if (urlParams.get("page") == "jobplace") {
		console.log(true);
		return <div>hello</div>;
	}
	return (
		<div className="container">
			<BrowserRouter>
				<Routes>
					<Route path="/wp-admin/admin.php" element={<Dashboard />} />
				</Routes>
			</BrowserRouter>
		</div>
	);
};

export default App;
