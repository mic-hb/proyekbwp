import { useState, useEffect } from "react";
import api from "@/api";
import GeneralLayout from "@/layouts/general";
import { usePage } from "@inertiajs/react";


export default function book() {
    const [isLoading, setIsLoading] = useState(true);
    const [hotel, setHotel] = useState({});
    const roomCode = usePage().props.id;
    useEffect(() => {
        const fetchData = async () => {
            setIsLoading(true);
            const hotelDetailRequest = await api.get(`/hotel/${roomCode}`);

            try {
                const [hotelResponse] = await Promise.all([
                    hotelDetailRequest.data,
                ]);
                setHotel(hotelResponse[0]);
                hotelResponse[0].image_urls.map((image) => {
                    image_urls.push(image);
                });
            } catch (error) {
                console.log(error);
            } finally {
                setIsLoading(false);
            }
        };
        fetchData();
    }, [setHotel]);
    return (
        <GeneralLayout isLoading={isLoading}>
            <div className="w-full flex">
                <h1 className="text-2xl font-bold">Hotel Booking</h1>
            </div>
            <div className="w-full flex flex-col shadow-lg rounded-lg px-4 py-3 gap-2">
                <label htmlFor="">Name</label>
                <input type="text" className="rounded-lg"/>
                <label htmlFor="">Phone Number</label>
                <input type="tel" className="rounded-lg"/>
                <label htmlFor="">Email</label>
                <input type="email" className="rounded-lg"/>
                <h1>Room Type: Room Type 1</h1>
                <h1 className="text-2xl font-semibold">Total: Rp 10 jeti</h1>
                <button type="submit" className="w-fit px-2 py-1 bg-blue-400 rounded-lg">Pay Now</button>
            </div>
        </GeneralLayout>
    )
}
