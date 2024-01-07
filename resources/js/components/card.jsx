import Rating from "@/components/rating";
export default function card({
    code,
    image,
    title,
    address,
    city,
    rating,
    price,
    action,
    favorite,
}) {
    return (
        <div className="w-full flex gap-4 rounded-xl shadow-2xl bg-gray-50">
            <img
                className="w-64 aspect-square object-cover rounded-xl"
                src={image}
                alt="..."
            />
            <div className="w-full">
                <div className="h-full flex flex-col justify-between p-4">
                    <div>
                        <div className="flex w-full">
                            <h5 className="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {title}
                            </h5>
                        </div>
                        <div className="flex w-full">
                            <h5 className="text-xl tracking-tight text-gray-900 dark:text-white">
                                {address}
                            </h5>
                        </div>
                        <div className="flex w-full">
                            <h5 className="text-lg tracking-tight text-gray-900 dark:text-white">
                                {city}
                            </h5>
                        </div>
                    </div>
                    <div>
                        <div className="flex w-full">
                            <Rating rating={rating} />
                        </div>
                        <div className="flex w-full">
                            {price ? (
                                <p className="font-normal text-gray-700 dark:text-gray-400">
                                    Rp. {price}
                                </p>
                            ) : (
                                <p className="font-normal text-gray-700 dark:text-gray-400">
                                    No Room Available
                                </p>
                            )}
                        </div>
                        <div className="flex gap-2">
                            {price ? (
                                <a href={`/hotel/${code}`}>
                                    <button className="w-full text-center px-2 py-1 bg-green-400 hover:bg-green-500 font-semibold rounded-lg">
                                        {action}
                                    </button>
                                </a>
                            ) : (
                                <a>
                                    <button
                                        disabled
                                        className="w-full text-center px-2 py-1 bg-slate-400 cursor-not-allowed  font-semibold rounded-lg"
                                    >
                                        {action}
                                    </button>
                                </a>
                            )}
                            <a href="">
                                <button className="w-full text-center px-2 py-1 bg-pink-400 hover:bg-pink-500 font-semibold rounded-lg">
                                    {favorite}
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
