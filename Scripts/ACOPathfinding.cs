// ACOPathfinding.cs
using System.Collections.Generic;
using UnityEngine;

public class ACOPathfinding : MonoBehaviour
{
    public Transform startNode;
    public List<Transform> goalNodes;
    public List<Transform> packageNodes;
    public float alpha = 1f;
    public float beta = 2f;
    public float Q = 1f;
    public int antCount = 10;
    public int maxIterations = 100;
    private Dictionary<(Transform, Transform), float> pheromones;
    private int packagesPicked = 0;
    private float totalDistance = 0f;

    void Start()
    {
        InitializePheromones();
        List<Transform> shortestPath = RunACO();
        Debug.Log("Shortest path found by ACO:");
        foreach (Transform node in shortestPath)
        {
            Debug.Log(node.name);
        }

        PickupPackages(shortestPath);

        List<Transform> returnPath = RunAStar(shortestPath[shortestPath.Count - 1], startNode);
        Debug.Log("Return path found by A*:");
        foreach (Transform node in returnPath)
        {
            Debug.Log(node.name);
        }

        PickupPackages(returnPath);

        totalDistance += CalculatePathLength(returnPath);

        FindObjectOfType<PerformanceDisplay>().UpdatePerformance(10f, totalDistance, packagesPicked);
    }

    void InitializePheromones()
    {
        pheromones = new Dictionary<(Transform, Transform), float>();
        foreach (Transform from in goalNodes)
        {
            foreach (Transform to in goalNodes)
            {
                if (from != to)
                {
                    pheromones[(from, to)] = 1f;
                }
            }
        }
    }

    List<Transform> RunACO()
    {
        List<Transform> bestPath = null;
        float bestLength = float.MaxValue;

        for (int iter = 0; iter < maxIterations; iter++)
        {
            List<List<Transform>> antPaths = new List<List<Transform>>();

            for (int ant = 0; ant < antCount; ant++)
            {
                List<Transform> path = GeneratePath();
                antPaths.Add(path);
                float length = CalculatePathLength(path);
                if (length < bestLength)
                {
                    bestLength = length;
                    bestPath = new List<Transform>(path);
                }
            }

            UpdatePheromones(antPaths);
        }

        return bestPath;
    }

    List<Transform> GeneratePath()
    {
        List<Transform> path = new List<Transform> { startNode };
        Transform current = startNode;
        HashSet<Transform> visited = new HashSet<Transform> { startNode };

        while (visited.Count < goalNodes.Count + 1)
        {
            Transform next = ChooseNextNode(current, visited);
            path.Add(next);
            visited.Add(next);
            current = next;
        }

        return path;
    }

    Transform ChooseNextNode(Transform current, HashSet<Transform> visited)
    {
        List<Transform> candidates = new List<Transform>();
        List<float> probabilities = new List<float>();
        float sum = 0f;

        foreach (Transform node in goalNodes)
        {
            if (!visited.Contains(node))
            {
                float pheromone = pheromones[(current, node)];
                float heuristic = 1f / Vector3.Distance(current.position, node.position);
                float probability = Mathf.Pow(pheromone, alpha) * Mathf.Pow(heuristic, beta);
                candidates.Add(node);
                probabilities.Add(probability);
                sum += probability;
            }
        }

        float rand = Random.value * sum;
        float cumulative = 0f;

        for (int i = 0; i < candidates.Count; i++)
        {
            cumulative += probabilities[i];
            if (cumulative >= rand)
            {
                return candidates[i];
            }
        }

        return null;
    }

    float CalculatePathLength(List<Transform> path)
    {
        float length = 0f;
        for (int i = 0; i < path.Count - 1; i++)
        {
            length += Vector3.Distance(path[i].position, path[i + 1].position);
        }
        return length;
    }

    void UpdatePheromones(List<List<Transform>> paths)
    {
        foreach (var key in pheromones.Keys)
        {
            pheromones[key] *= 0.9f; // Evaporation
        }

        foreach (List<Transform> path in paths)
        {
            float length = CalculatePathLength(path);
            for (int i = 0; i < path.Count - 1; i++)
            {
                Transform from = path[i];
                Transform to = path[i + 1];
                pheromones[(from, to)] += Q / length;
            }
        }
    }

    List<Transform> RunAStar(Transform start, Transform goal)
    {
        PriorityQueue<Transform, float> openSet = new PriorityQueue<Transform, float>();
        Dictionary<Transform, Transform> cameFrom = new Dictionary<Transform, Transform>();
        Dictionary<Transform, float> gScore = new Dictionary<Transform, float> { [start] = 0f };
        Dictionary<Transform, float> fScore = new Dictionary<Transform, float> { [start] = Vector3.Distance(start.position, goal.position) };

        openSet.Enqueue(start, fScore[start]);

        while (openSet.Count > 0)
        {
            Transform current = openSet.Dequeue();

            if (current == goal)
            {
                return ReconstructPath(cameFrom, current);
            }

            foreach (Transform neighbor in goalNodes)
            {
                if (neighbor == current) continue;

                float tentativeGScore = gScore[current] + Vector3.Distance(current.position, neighbor.position);

                if (!gScore.ContainsKey(neighbor) || tentativeGScore < gScore[neighbor])
                {
                    cameFrom[neighbor] = current;
                    gScore[neighbor] = tentativeGScore;
                    fScore[neighbor] = gScore[neighbor] + Vector3.Distance(neighbor.position, goal.position);

                    if (!openSet.Contains(neighbor))
                    {
                        openSet.Enqueue(neighbor, fScore[neighbor]);
                    }
                }
            }
        }

        return null;
    }

    List<Transform> ReconstructPath(Dictionary<Transform, Transform> cameFrom, Transform current)
    {
        List<Transform> path = new List<Transform> { current };
        while (cameFrom.ContainsKey(current))
        {
            current = cameFrom[current];
            path.Add(current);
        }
        path.Reverse();
        return path;
    }

    void PickupPackages(List<Transform> path)
    {
        foreach (Transform node in path)
        {
            if (packageNodes.Contains(node))
            {
                packagesPicked++;
                Debug.Log($"Picked up package at {node.name}");
                packageNodes.Remove(node);
            }
        }

        totalDistance += CalculatePathLength(path);
    }
}
