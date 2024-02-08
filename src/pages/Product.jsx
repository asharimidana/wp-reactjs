import React, { useState, useEffect } from "react";
import axios from "axios";

const Product = () => {
	const [id, setId] = useState("");
	const [datax, setData] = useState([]);
	useEffect(() => {}, []);

	const getData = async (e) => {
		try {
			e.preventDefault();
			const response = await axios.get("https://jsonplaceholder.org/users");
			setData(response.data);
			return response.data;
		} catch (err) {}
	};
	return (
		<div className="dashboard  bg-red-300">
			<div className="border pl-1 py-1">
				<h3 className="text-white">Product Page</h3>
				<p>
					dit Dashboard component at <code>src/components/Dashboard.jsx</code>
				</p>
				<button
					type="button"
					className="bg-violet-500 hover:bg-violet-700 mr-2 py-1 px-2 rounded text-white"
					onClick={getData}
				>
					Get User
				</button>
				<button
					onClick={() => setData([])}
					className="bg-red-500 hover:bg-red-700 mr-2 py-1 px-2 rounded text-white"
				>
					Delete
				</button>

				{datax.map((item, index) => (
					<div className="bg-primary">
						<ul>{item.id}</ul>
						<ul>{item.email}</ul>
					</div>
				))}
			</div>
		</div>
	);
};

export default Product;
