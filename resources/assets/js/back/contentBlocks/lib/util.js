export function box(v) {
    return {
        map: f => box(f(v)),
        fold: f => (f === undefined) ? v : f(v),
    };
}