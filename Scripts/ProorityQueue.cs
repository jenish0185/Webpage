using System.Collections.Generic;

public class PriorityQueue<TElement, TPriority>
{
    private readonly SortedList<TPriority, Queue<TElement>> _elements = new SortedList<TPriority, Queue<TElement>>();

    public int Count { get; private set; }

    public void Enqueue(TElement element, TPriority priority)
    {
        if (!_elements.ContainsKey(priority))
        {
            _elements[priority] = new Queue<TElement>();
        }

        _elements[priority].Enqueue(element);
        Count++;
    }

    public TElement Dequeue()
    {
        if (Count == 0)
        {
            throw new System.InvalidOperationException("The priority queue is empty.");
        }

        // Access the first element in the SortedList
        var firstKey = _elements.Keys[0]; // Get the smallest key
        var firstQueue = _elements[firstKey]; // Get the queue for that key
        var element = firstQueue.Dequeue(); // Dequeue the element

        // Remove the key if the queue is now empty
        if (firstQueue.Count == 0)
        {
            _elements.Remove(firstKey);
        }

        Count--;
        return element;
    }


    public bool Contains(TElement element)
    {
        foreach (var queue in _elements.Values)
        {
            if (queue.Contains(element))
            {
                return true;
            }
        }
        return false;
    }
}
